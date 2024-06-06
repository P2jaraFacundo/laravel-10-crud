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
    
            // Obtener solo la parte después del "@" en la acción del controlador
            $actionParts = explode('@', $action);
            $controllerAction = end($actionParts);
    
            // Lista de acciones del estudiante
            $studentsActions = [
                'store',
                'update',
                'destroy',
            ];
    
            // Verificar si la acción actual está en la lista 
            if (in_array($controllerAction, $studentsActions)) {
                // Registrar la acción
                ActionLog::create([
                    'user_id' => Auth::user()->id,
                    'action' => $controllerAction,
                    'ip' => $request->ip(),
                    'timestamp' => Carbon::now()->toDateTimeString(),
                    'browser' => $request->header('user-agent')
                ]);
            }
        }
    
        return $next($request);
    }
    
    
}
