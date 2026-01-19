<?php

namespace App\Http\Middleware;

use App\Helpers\LogConfig;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LogRequestInOutMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // logging IN
        LogConfig::logRequestInOut($request, $request->input());

        $response = $next($request);

        // ambil $data yang “dititipkan” dari controller, boleh bernilai null
        $logData = $request->attributes->get('log_out_data') ?? 'info';

        // logging OUT
        LogConfig::logRequestInOut($request, [$response->original], 'OUT', $logData);

        return $response;
    }
}
