<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Assist; // Importamos el modelo Student
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\StoreAssistRequest;
use App\Http\Requests\UpdateStudentRequest;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() 
    {

        return view('student.index', [
            'students' => Student::latest()->paginate(3)
        ]);
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
            // Redirigir al método show pasando el ID del estudiante
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
        
        // Buscar el estudiante por su DNI
        $student = Student::where('dni', $dni)->first();
        
        if ($student) {
            // Crear la asistencia 
            Assist::create([
                'student_id' => $student->id,
                'dni' => $dni,
                'assist' => now(), //  fecha y hora actual 
            ]);
    
            // Redirigir al método show pasando el ID del estudiante
            return redirect()->route('students.index')
                        ->withSuccess('New Assist is added successfully.');
        } 
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
        return view('student.show', [
            'student' => $student
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