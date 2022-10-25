<?php

namespace App\Http\Middleware;

use Closure;

class AuthStaticToken
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
        $auth = $request->header('Authorization');
        if ($auth === "7V55E=Gz#Ng6r+Nw") {
            return $next($request);
        }
        return response()->json(['message' => 'Unauthorized'], 401);
    }
}
