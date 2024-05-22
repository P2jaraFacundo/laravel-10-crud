<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\ActionLog; // Asegúrate de importar el modelo correspondiente
use \Carbon\Carbon; // Importa la clase Carbon

class LogActions
{
    public function handle(Request $request, Closure $next)
    {
        // Obtener la acción como una cadena
        $action = $request->route() ? $request->route()->getActionName() : 'Unknown Action';
        
        // Registra la acción en la base de datos
        ActionLog::create([
            'action' => is_array($action) ? implode('@', $action) : $action,
            'ip' => $request->ip(),
            'timestamp' => Carbon::now()->toDateTimeString(),
        ]);

        return $next($request);
    }
}
