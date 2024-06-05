@extends('layout.layouts')

@section('content')

<div class="row justify-content-center mt-3">
    <div class="col-md-8">

        @if ($message = Session::get('success'))
            <div class="alert alert-success" role="alert">
                {{ $message }}
            </div>
        @endif

        <div class="card">
            <div class="card-header">
                <div class="float-start">
                    Edit Student
                </div>
                <div class="float-end">
                    <a href="{{ route('students.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('students.update', $student->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3 row">
                        <label for="dni" class="col-md-4 col-form-label text-md-end text-start">Dni</label>
                        <div class="col-md-6">
                            <input type="number" class="form-control @error('dni') is-invalid @enderror" id="dni" name="dni" value="{{ $student->dni }}">
                            @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('dni') }}</span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="mb-3 row">
                        <label for="name" class="col-md-4 col-form-label text-md-end text-start">Name</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $student->name }}">
                            @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="surname" class="col-md-4 col-form-label text-md-end text-start">Surname</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control @error('surname') is-invalid @enderror" id="surname" name="surname" value="{{ $student->surname }}">
                            @if ($errors->has('surname'))
                                <span class="text-danger">{{ $errors->first('surname') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="date_of_birth" class="col-md-4 col-form-label text-md-end text-start">Date of Birth</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control @error('date_of_birth') is-invalid @enderror" id="date_of_birth" name="date_of_birth" value="{{ $student->date_of_birth }}">
                            @if ($errors->has('date_of_birth'))
                                <span class="text-danger">{{ $errors->first('date_of_birth') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="group" class="col-md-4 col-form-label text-md-end text-start">Group</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control @error('group') is-invalid @enderror" id="group" name="group" value="{{ $student->group }}">
                            @if ($errors->has('group'))
                                <span class="text-danger">{{ $errors->first('group') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="year" class="col-md-4 col-form-label text-md-end text-start">Year</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control @error('year') is-invalid @enderror" id="year" name="year" value="{{ $student->year }}">
                            @if ($errors->has('year'))
                                <span class="text-danger">{{ $errors->first('year') }}</span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="mb-3 row">
                        <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Update">
                    </div>
                    
                </form>
            </div>
        </div>
    </div>    
</div>
    
@endsection
