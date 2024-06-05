<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Parameter;
use App\Models\Assist; // Importamos el modelo Student
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\StoreAssistRequest;
use App\Http\Requests\UpdateStudentRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\StudentExport;
use App\Models\ActionLog;



class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function index(Request $request)
    {
         // Recuperar el año filtrado de la sesión si está disponible
        $filteredYear = $request->query('year', Session::get('filtered_year'));
    
         // Si se envió un año en la solicitud, actualizar el año filtrado en la sesión
        if ($request->filled('year')) {
            $filteredYear = $request->year;
            Session::put('filtered_year', $filteredYear);
        }
    
        $students = Student::query();
    
         // Filtrar por año 
        if ($filteredYear !== null) {
            $students->where('year', $filteredYear);
        }
    
         // Paginar los resultados
        $students = $students->paginate(10);
    
        return view('student.index', compact('students'));
    }

    


        public function admin()
    {
        $action_logs = ActionLog::all(); 
        
        return view('admin.admin', compact('action_logs'));
    
    }




    /**
     * Show the form for creating a new resource.
     */
    public function create() : View
    {
        return view('student.create');
    }

    public function addAssist() : View
    {
        return view('student.addAssist');
    }

    public function findStudent(StoreAssistRequest $request) : RedirectResponse
    {
        // Obtener el DNI del formulario
        $dni = $request->dni;
        
        // Buscar el estudiante por su DNI
        $student = Student::where('dni', $dni)->first();
        
        if ($student) {
            //  redirigir a show , junto con la id del student encontrado
            return redirect()->route('students.show', ['student' => $student->id]);
        } else {
            // Si no se encuentra el estudiante
            return redirect()->route('students.index')
                        ->withSuccess('ERROR : Student not found for the provided DNI.');
        }
        
    }
    

    public function storeAssist(StoreAssistRequest $request) : RedirectResponse
{
    // Obtener el DNI del formulario
    $dni = $request->dni;
    
    // Buscar el student
    $student = Student::where('dni', $dni)->first();
    
    if ($student) {
        // verifica si existe una asistencia
        $existingAssist = Assist::where('student_id', $student->id)
                                ->whereDate('assist', now()->toDateString())
                                ->first();
        
        if ($existingAssist) {
            return redirect()->route('students.index')
                        ->withSuccess('The assist for today has already been recorded.');
        }

        // Crear la asistencia 
        Assist::create([
            'student_id' => $student->id,
            'dni' => $dni,
            'assist' => now(), // fecha y hora actual 
        ]);

        // redigir al index con cartel de exito
        return redirect()->route('students.index')
                    ->withSuccess('New assist is added successfully.');
    }
    
    // Redirigir a index si no encuentra el student
    return redirect()->route('students.index')
                ->withErrors('Student not found.');
}



    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStudentRequest $request) : RedirectResponse
    {
        $data = $request->except('_token');

        // Validar la edad 
        $date_of_birth = \Carbon\Carbon::parse($data['date_of_birth']);
        $age = $date_of_birth->diffInYears(\Carbon\Carbon::now());
        
        if ($age < 18) {
            return redirect()->back()->withInput()->withErrors(['date_of_birth' => 'The student must be over 18 years old.']);
        }

        Student::create($data);
        return redirect()->route('students.index')->withSuccess('New Student is added successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Student $student) : View
    {
        // Obtener los parámetros
        $parameter = DB::table('parameters')->first();
    
        // Contar las asistencias del estudiante
        $totalAssists = $student->assist()->count();
    
        // Calcular el porcentaje de asistencias
        $Percentaje = round((($totalAssists / $parameter->class_days) * 100),2);
    
        // Determinar la condición del estudiante
        if ($Percentaje >= $parameter->promotion_percentage) {
            $condition = 'Promotion';
        } elseif ($Percentaje >= $parameter->regular_percentage) {
            $condition = 'Regular';
        } else {
            $condition = 'Free';
        }
    
        return view('student.show', [
            'student' => $student,
            'condition' => $condition,
            'Percentaje' => $Percentaje
        ]);
    }
    

    
    public function showAssists($id) : View
    {
        // Obtener el estudiante por su ID
        $student = Student::findOrFail($id);
        
        // Obtener todas las asistencias del estudiante
        $assists = $student->assist; 
    
        return view('student.assists', [
            'student' => $student,
            'assists' => $assists
        ]);
    }
    
    public function downloadPDF($id)
    {
        $student = Student::findOrFail($id);
    
        // Obtener la cantidad total de clases 
        $parameters = Parameter::first(); 
        $totalClasses = $parameters->class_days;
    
        // Obtener las asistencias del estudiante
        $assists = Assist::where('student_id', $id)->get();
        $attendedClasses = $assists->count();
        $percentage = round((($attendedClasses / $totalClasses) * 100),2);
        
    
        // Calcular la condición del estudiante
        $condition = '';
            if ($percentage >= $parameters->promotion_percentage) {
                $condition = '<span style="color: blue;">Promotion</span>';
            } elseif ($percentage >= $parameters->regular_percentage) {
                $condition = '<span style="color: green;">Regular</span>';
            } else {
                $condition = '<span style="color: red;">Free</span>';
            }
    
    
            // Renderiza la vista Blade y pasa los datos
        $pdfContent = view('student.pdf', [
            'student' => $student,
            'attendedClasses' => $attendedClasses,
            'condition' => $condition,
            'percentage' => $percentage,
        ])->render();

        // Genera PDF
        $pdf = PDF::loadHTML($pdfContent);

        // Descarga
        return $pdf->download("$student->surname" . "_" . "$student->name" . "_report.pdf");
    }





    public function downloadEXCEL($id)
{
    $student = Student::findOrFail($id);
    $parameters = Parameter::first();
    $totalClasses = $parameters->class_days;
    $assists = Assist::where('student_id', $id)->get();
    $attendedClasses = $assists->count();
    $percentage = round((($attendedClasses / $totalClasses) * 100), 2);
    $condition = '';

    if ($percentage >= $parameters->promotion_percentage) {
        $condition = 'Promotion';
    } elseif ($percentage >= $parameters->regular_percentage) {
        $condition = 'Regular';
    } else {
        $condition = 'Free';
    }

    return Excel::download(new StudentExport($student, /* $totalClasses, */ $attendedClasses, $condition, $percentage), "$student->surname" . "_" . "$student->name" . "_report.xlsx");
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student) : View
    {
        return view('student.edit', [
            'student' => $student
        ]);
    }





    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStudentRequest $request, Student $student) : RedirectResponse
    {
        $validatedData = $request->validated(); // Obtener solo los datos validados por el formulario
        
        $student->update($validatedData); // Actualizar el estudiante con los datos validados
        
        return redirect()->route('students.index')
                ->withSuccess('Student is updated successfully.');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student) : RedirectResponse
    {
        $student->delete();
        return redirect()->route('students.index')
                ->withSuccess('Student is deleted successfully.');
    }
}