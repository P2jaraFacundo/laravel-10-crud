<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\ActionLog;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class LogActions
{
    public function handle(Request $request, Closure $next)
    {
        // Verificar si hay un usuario autenticado
        if (Auth::check()) {
            // Obtener la acción como una cadena de texto
            $action = $request->route() ? $request->route()->getActionName() : 'Unknown Action';
    
            // Lista de acciones del estudiante
            $studentsActions = [
                'App\Http\Controllers\StudentController@store',
                'App\Http\Controllers\StudentController@update',
                'App\Http\Controllers\StudentController@destroy',
            ];
    
            // Verificar si la acción actual está en la lista 
            if (in_array($action, $studentsActions)) {
                // Registrar la acción
                ActionLog::create([
                    'user_id' => Auth::user()->id,
                    'action' => $action,
                    'ip' => $request->ip(),
                    'timestamp' => Carbon::now()->toDateTimeString(),
                    'browser' => $request->header('user-agent')
                ]);
            }
        }
    
        return $next($request);
    }
    
}
