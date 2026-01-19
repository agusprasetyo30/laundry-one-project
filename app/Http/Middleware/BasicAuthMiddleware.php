<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response as FacadesResponse;
use Symfony\Component\HttpFoundation\Response;

class BasicAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $username = config('apiconfig.api_auth_username'); // ganti sesuai kebutuhan
        $password = config('apiconfig.api_auth_password'); // ganti sesuai kebutuhan

        $hasValidCredentials = $request->getUser() === $username &&
            $request->getPassword() === $password;

        if (!$hasValidCredentials) {
            return FacadesResponse::unauthorized(null, 'Username or password incorrect')
                ->header('WWW-Authenticate', 'Basic');
        }

        return $next($request);
    }
}
