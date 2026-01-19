<?php
namespace App\Helpers;

use Illuminate\Http\Client\Response as ClientResponse;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\JsonResponse;

class ApiConfig {
   /**
     * API default untuk mengirimkan data ke server
     * @param string $method
     * @param string $endpoint
     * @param array $data
     */
      public static function sendApiRequest(string $method, string $endpoint, array $data): ClientResponse|array|JsonResponse {
         try {
            return Http::timeout(300)->withHeaders([
                  'Gateway' => config('microservice.gateway_api'),
                  'Accept' => 'application/json',
            ])->withBasicAuth(
                  config('microservice.username'),
                  config('microservice.password'))
            ->{$method}(config('microservice.base_url') . "/api/{$endpoint}", $data);
         } catch (\Throwable $th) {
            return LogConfig::errorMessageWithID($th, "Failed to connect to external API", true);
         }
      }
}