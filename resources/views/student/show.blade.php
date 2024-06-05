@extends('layout.layouts')

@section('content')

<div class="row justify-content-center mt-3">
    <div class="col-md-8">

        <div class="card">
            <div class="card-header">
                <div class="float-start">
                    Student Information
                </div>
                <div class="float-end">
                    <a href="{{ route('students.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
                </div>
            </div>
            <div class="card-body">

                <div class="row">
                    <label for="code" class="col-md-4 col-form-label text-md-end text-start"><strong>Dni:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ $student->dni }}
                    </div>
                </div>
            
                <div class="row">
                    <label for="name" class="col-md-4 col-form-label text-md-end text-start"><strong>Name:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ $student->name }}
                    </div>
                </div>

                <div class="row">
                    <label for="quantity" class="col-md-4 col-form-label text-md-end text-start"><strong>Surname:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ $student->surname }}
                    </div>
                </div>

                <div class="row">
                    <label for="price" class="col-md-4 col-form-label text-md-end text-start"><strong>Date of Birth:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ date("d-m-Y", strtotime($student->date_of_birth)) }}
                    </div>
                </div>

                <div class="row">
                    <label for="description" class="col-md-4 col-form-label text-md-end text-start"><strong>Group:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ $student->year }}
                    </div>
                </div>
                
                <div class="row">
                    <label for="description" class="col-md-4 col-form-label text-md-end text-start"><strong>Group:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ $student->group }}
                    </div>
                </div>

                <div class="row">
                    <label for="description" class="col-md-4 col-form-label text-md-end text-start"><strong>Condition:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        @if($condition === 'Promotion')
                            <span style="color: blue;">{{ $condition }}</span>
                        @elseif($condition === 'Regular')
                            <span style="color: green;">{{ $condition }}</span>
                        @else
                            <span style="color: red;">{{ $condition }}</span>
                        @endif
                        ({{ $Percentaje }}%)
                    </div>
                </div>
                
        
                <div class="card-body">
                    <form action="{{ route('students.storeAssist') }}" method="post">
                        @csrf
                        <input type="hidden" name="dni" value="{{ $student->dni }}">
                        <div class="mb-3 row"> </div>
                        <div class="mb-3 row">
                            <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Add Assist">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>    
</div>
    
@endsection
