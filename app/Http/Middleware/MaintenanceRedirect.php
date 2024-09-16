<?php

namespace App\Http\Middleware;

use Closure;

class MaintenanceRedirect
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
         // Redirigir a la vista de mantenimiento
         return response()->view('tramites.mantenimiento');
    }
}
