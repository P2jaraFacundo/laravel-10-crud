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
                    <label for="name" class="col-md-4 col-form-label text-md-end text-start"><strong>Date of Assists:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        <ul>
                            @forelse($assists as $assist)
                                <li>✅ {{ $assist->assist }}</li> <!-- Muestra la fecha de asistencia -->
                            @empty
                                <li>❌ No assists found</li>
                            @endforelse
                        </ul>
                    </div>
                    
                </div>

            </div>
        </div>
    </div>    
</div>

@endsection
