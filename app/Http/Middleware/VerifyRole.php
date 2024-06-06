<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class VerifyRole
{
    public function handle($request, Closure $next)
    {
        $user = Auth::user();
        
        if ($user && $user->role && $user->role->role_name === 'admin') {
            return $next($request);
        }

        return redirect()->route('students.index')
                        ->withSuccess('ERROR : You do not have permissions to perform this action');
    }
}
