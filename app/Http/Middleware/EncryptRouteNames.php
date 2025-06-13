<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Crypt;

class EncryptRouteNames
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
        // Encrypt all route names
        foreach (Route::getRoutes() as $route) {
            if ($route->getName()) {
                $encryptedName = Crypt::encryptString($route->getName());
                $route->name($encryptedName);
            }
        }

        return $next($request);
    }
}
