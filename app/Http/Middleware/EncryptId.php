<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;

class EncryptId
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->route('id')) {
            try {
                $request->merge(['id' => Crypt::decryptString($request->route('id'))]);
            } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
                abort(404);
            }
        }

        return $next($request);
    }
}
