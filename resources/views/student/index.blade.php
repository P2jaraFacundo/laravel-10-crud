@extends('layout.layouts')

@section('content')

<div class="row justify-content-center mt-3">
    <div class="col-md-12">

        @if ($message = Session::get('success'))
            <div class="alert alert-success" role="alert">
                {{ $message }}
            </div>
        @endif

        <div class="card">
            <div class="card-header">Student List</div>
            <div class="card-body">
                <a href="{{ route('students.create') }}" class="btn btn-success btn-sm my-2"><i class="bi bi-plus-circle"></i> Add New Student</a>
                <a href="{{ route('students.addAssist') }}" class="btn btn-danger btn-sm my-2"><i class="bi bi-plus-circle"></i> Add New Assist For DNI</a>
                <table class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Dni</th>
                        <th scope="col">Name</th>
                        <th scope="col">Surname</th>
                        <th scope="col">Date of Birth</th>
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
                            <td>{{ $student->group }}</td>
                            <td>
                                <form action="{{ route('students.destroy', $student->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    
                                    <a href="{{ route('students.showAssists', $student->id) }}" class="btn btn-success btn-sm"><i class="bi bi-pencil-square"></i> Assists</a>

                                    <a href="{{ route('students.show', $student->id) }}" class="btn btn-warning btn-sm"><i class="bi bi-eye"></i> Show</a>
                                    
                                    <a href="{{ route('students.edit', $student->id) }}" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i> Edit</a>   

                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Do you want to delete this student?');"><i class="bi bi-trash"></i> Delete</button>
                                </form>
                            </td>
                            <td>
                                @if(date("d-m", strtotime($student->date_of_birth)) === date("d-m"))
                                    <span class="badge bg-warning">Hoy es su cumpleaños </span> {{ date_diff(date_create($student->date_of_birth), date_create('today'))->y }} años.
                                @endif

                            </td>
                        </tr>
                        @empty
                            <td colspan="5">
                                <span class="text-danger">
                                    <strong>No Student Found!</strong>
                                </span>
                            </td>
                        @endforelse
                    </tbody>
                  </table>

                  {{ $students->links() }}

            </div>
        </div>
    </div>    
</div>
    
@endsection
