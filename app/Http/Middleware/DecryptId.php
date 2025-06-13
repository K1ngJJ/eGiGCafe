<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;

class DecryptId
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
        // Decrypt the ID if it's present in the route
        if ($request->route('encryptedId')) {
            try {
                // Decrypt the ID
                $decryptedId = Crypt::decryptString($request->route('encryptedId'));
                $request->merge(['id' => $decryptedId]);
            } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
                abort(404); // ID decryption failed, return a 404 error
            }
        }

        return $next($request);
    }
}
