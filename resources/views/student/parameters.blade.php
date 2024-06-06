@extends('layout.layouts')

@section('content')
<div class="row justify-content-center mt-3">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <div class="float-start">
                    Edit Parameters
                </div>
                <div class="float-end">
                    <a href="{{ route('students.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('Parameters.editParameters') }}" method="POST">
                    @csrf
                    <input type="hidden" value="1" name="id">
                    
                    <div class="mb-3 row">
                        <label for="class_days" class="col-md-4 col-form-label text-md-end text-start">Class days</label>
                        <div class="col-md-6">
                            <input type="number" class="form-control @error('class_days') is-invalid @enderror" id="class_days" name="class_days" value="{{ old('class_days') }}">
                            @error('class_days')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                
                    <div class="mb-3 row">
                        <label for="promotion_percentage" class="col-md-4 col-form-label text-md-end text-start">Percentage to promote</label>
                        <div class="col-md-6">
                            <input type="number" class="form-control @error('promotion_percentage') is-invalid @enderror" id="promotion_percentage" name="promotion_percentage" value="{{ old('promotion_percentage') }}">
                            @error('promotion_percentage')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                
                    <div class="mb-3 row">
                        <label for="regular_percentage" class="col-md-4 col-form-label text-md-end text-start">Percentage to regularize</label>
                        <div class="col-md-6">
                            <input type="number" class="form-control @error('regular_percentage') is-invalid @enderror" id="regular_percentage" name="regular_percentage" value="{{ old('regular_percentage') }}">
                            @error('regular_percentage')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                
                    <div class="mb-3 row">
                        <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Edit Parameters">
                    </div>
                </form>                
            </div>
        </div>
    </div>    
</div>
@endsection
