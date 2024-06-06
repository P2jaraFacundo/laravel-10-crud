@extends('layout.layouts')

@section('content')

<div class="row justify-content-center mt-3">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">Action List</div>
            <div class="card-body">
                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th scope="col">Id Usuario</th>
                        <th scope="col">Fecha y hora</th>
                        <th scope="col">Accion</th>
                        <th scope="col">Ip</th>
                        <th scope="col">Browser</th>
                    </tr>
                    </thead>
                    <tbody>
                        @forelse ($action_logs as $action_log)
                            <tr>
                                <td>{{ $action_log->user->name }}</td> {{-- modelo relacionado con el user --}}
                                <td>{{ $action_log->timestamp }}</td>
                                <td>{{ $action_log->action }}</td>
                                <td>{{ $action_log->ip }}</td>
                                <td>{{ $action_log->browser }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">
                                    <span class="text-danger">
                                        <strong>No Actions Found!</strong>
                                    </span>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>    
</div>
    
@endsection
