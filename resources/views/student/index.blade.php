@extends('layout.layouts')

@section('content')

<div class="row justify-content-center mt-3">
    <div class="col-md-12">

        @if ($message = Session::get('success'))
            <div class="alert alert-success" role="alert">
                {{ $message }}
            </div>
        @endif


        <!-- Formulario de filtro -->
        <form action="{{ route('students.index') }}" method="GET">
            <div class="input-group mb-3">
                <select class="form-select" name="year">
                    <option value="">Filter by year</option>
                    <option value="1" {{ Session::get('filtered_year') == '1' ? 'selected' : '' }}>1st Year</option>
                    <option value="2" {{ Session::get('filtered_year') == '2' ? 'selected' : '' }}>2nd Year</option>
                    <option value="3" {{ Session::get('filtered_year') == '3' ? 'selected' : '' }}>3rd Year</option>
                </select>
                <button class="btn btn-primary" type="submit">Filtrar</button>
            </div>
        </form>


        <div class="card">
            <div class="card-header">Student List</div>
            <div class="card-body">
                <a href="{{ route('students.create') }}" class="btn btn-success btn-sm my-2"><i class="bi bi-plus-circle"></i> Add New Student</a>
                <a href="{{ route('students.addAssist') }}" class="btn btn-danger btn-sm my-2"><i class="bi bi-plus-circle"></i> Add New Assist For DNI</a>
                <a href="{{ route('Parameters.addParameters') }}" class="btn btn-primary btn-sm my-2"><i class="bi bi-plus-circle"></i> Parameters</a>
                <a href="{{ route('students.admin') }}" class="btn btn-primary btn-sm my-2"><i class="bi bi-plus-circle"></i> Actions</a>
                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Dni</th>
                        <th scope="col">Name</th>
                        <th scope="col">Surname</th>
                        <th scope="col">Date of Birth</th>
                        <th scope="col">Year</th>
                        <th scope="col">Group</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @forelse ($students as $student)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $student->dni }}</td>
                            <td>{{ $student->name }}</td>
                            <td>{{ $student->surname }}</td>
                            <td>{{ date("d-m-Y", strtotime($student->date_of_birth)) }}</td>
                            <td>{{ $student->year }}</td>
                            <td>{{ $student->group }}</td>
                            <td>
                                <form action="{{ route('students.destroy', $student->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    
                                    <a href="{{ route('students.showAssists', $student->id) }}" class="btn btn-success btn-sm"><i class="bi bi-pencil-square"></i> Assists</a>

                                    <a href="{{ route('students.show', $student->id) }}" class="btn btn-warning btn-sm"><i class="bi bi-eye"></i> Show</a>
                                    
                                    <a href="{{ route('students.edit', $student->id) }}" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i> Edit</a>   

                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Do you want to delete this student?');"><i class="bi bi-trash"></i> Delete</button>
                                
                                    <a href="{{ route('students.downloadPDF', $student->id) }}" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i> PDF</a>
                                    
                                    <a href="{{ route('students.downloadEXCEL', $student->id) }}" class="btn btn-success btn-sm"><i class="bi bi-pencil-square"></i> EXCEL</a> 
                                </form>
                            </td>
                            <td>
                                @if(date("d-m", strtotime($student->date_of_birth)) === date("d-m")) {{-- Compara la fecha actual y la fecha de cumpleaños del estudiante --}}
                                    <span class="badge bg-warning">Hoy es su cumpleaños </span> {{ date_diff(date_create($student->date_of_birth), date_create('today'))->y }} años. {{-- Calcula la dif de la fecha de cumpl del estudiante y la fecha de hoy --}}
                                @endif
                            </td>
                        </tr>
                        @empty
                            <td colspan="8">
                                <span class="text-danger">
                                    <strong>No Student Found!</strong>
                                </span>
                            </td>
                        @endforelse
                    </tbody>
                </table>

                {{ $students->appends(['year' => Session::get('filtered_year')])->links() }}

            </div>
        </div>
    </div>    
</div>
    
@endsection
