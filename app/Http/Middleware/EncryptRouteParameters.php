<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Crypt;

class EncryptRouteParameters
{
    public function handle($request, Closure $next)
    {
        if ($request->route()) {
            $parameters = $request->route()->parameters();
            foreach ($parameters as $key => $value) {
                try {
                    $decryptedValue = Crypt::decryptString($value);
                    $request->route()->setParameter($key, $decryptedValue);
                } catch (\Exception $e) {
                    // Handle decryption error (if needed)
                }
            }
        }
        return $next($request);
    }
}
