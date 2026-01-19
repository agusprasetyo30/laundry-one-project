<?php

namespace App\Providers;

use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Response as FacadeResponse;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Symfony\Component\HttpFoundation\JsonResponse;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
         // This macro will be used to return a successful response with a 200 status code
        FacadeResponse::macro('ok', function ($data = [], $message = 'OK'): JsonResponse {
            return response()->json([
                'status' => "success",
                'message' => $message,
                'data' => $data,
            ], 200);
        });

        // This macro will be used to return a successful response wwith a 201 status code
        FacadeResponse::macro('created', function ($data = [], $message = 'Created'): JsonResponse {
            return response()->json([
                'status' => "success",
                'message' => $message,
                'data' => $data,
            ], 201);
        });

        // This macro will be used to return a successful response wwith a 202 status code
        FacadeResponse::macro('updated', function ($data = [], $message = 'Updated', $showRequest = false): JsonResponse {
            return response()->json([
                'status' => "success",
                'message' => $message,
                'data' => $showRequest ? $data : null,
            ], 204);
        });

        // This macro will be used to return unauthorized response with a 401 status code
        FacadeResponse::macro('unauthorized', function ($data = [], $message = 'Unauthorized'): JsonResponse {
            return response()->json([
                'status' => "failed",
                'message' => $message,
                'data' => $data,
            ], 401);
        });
        
        // This macro will be used to return forbidden response with a 403 status code
        FacadeResponse::macro('forbidden', function ($data = [], $message = 'Forbidden'): JsonResponse {
            return response()->json([
                'status' => "forbidden",
                'message' => $message,
                'data' => $data,
            ], 403);
        });

        // This macro will be used to return not found response with a 404 status code
        FacadeResponse::macro('notFound', function ($data = [], $message = 'Not Found'): JsonResponse {
            return response()->json([
                'status' => "not_found",
                'message' => $message,
                'data' => $data,
            ], 404);
        });

        // This macro will be used to return conflict response with a 409 status code
        FacadeResponse::macro('conflict', function ($data = [], $message = 'Conflict'): JsonResponse {
            return response()->json([
                'status' => "conflict",
                'message' => $message,
                'data' => $data,
            ], 409);
        });
        
        // This macro will be used to return unprocessable content / validation response with a 422 status code
        FacadeResponse::macro('unproccessableContent', function ($data = [], $message = 'Unprocessable Content'): JsonResponse {
            return response()->json([
                'status' => "failed",
                'message' => $message,
                'data' => $data,
            ], 422);
        });

        // This macro will be used to return internal server error response with a 500 status code
        FacadeResponse::macro('internalServerError', function ($data, $message = 'Internal Server Error'): JsonResponse {
            return response()->json([
                'status' => "failed",
                'message' => $message,
                'data' => $data,
            ], 500);
        });


        // Menambahkan configurasi untuk memaksa user untuk menggunakan url default
        if (config('app.env') !== 'local') {
            URL::forceRootUrl(config('app.url'));
    
            if (str_starts_with(config('app.url'), 'https://')) {
                URL::forceScheme('https');
            }
        }
    }
}
