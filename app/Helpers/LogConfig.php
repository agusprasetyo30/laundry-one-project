<?php
namespace App\Helpers;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Str;
use Throwable;

class LogConfig
{

   /**
    * Digunakan untuk logging setiap transaksi sesuai kebutuhan
    * @param string $query
    * @param array $bindings
    * @param string $typeQuery => SELECT, INSERT, UPDATE, DELETE
    * @return void
    */
   public static function sqlTransactionLogging(string $query, array $bindings, string $typeQuery = 'SELECT')
   {
      Log::info("Query Executed : {$typeQuery}", [
         'sql' => $query,
         'bindings' => $bindings,
      ]);
   }

   /**
    * Digunakan untuk logging setiap transaksi, yang dimana diambil dari getQueryLog()
    * @param string $typeQuery
    * @param array $loggingQuery
    * @return void
    */
   public static function sqlTransactionLoggingCustom(array $loggingQuery, string $typeQuery = 'SELECT')
   {
      Log::info("Query Executed : {$typeQuery}", $loggingQuery);
   }

   /**
    * Digunakan untuk logging request transaksi, ini digunakan untuk transaction IN & OUT
    * @param mixed $request
    * @param array $data
    * @param string $type ('IN & OUT')
    * @param mixed $logType
    * @return void
    */
   public static function logRequestInOut($request, array $data, string $type = 'IN', $logType = 'info')
   {
      \Log::{$logType}("Request Transaction => {$type}", [
         'ip' => $request->ip(),
         'endpoint' => $request->getRequestUri(),
         'data' => $data
      ]);
   }

   /**
    * Digunakan untuk menyimpan data logging di tabel API_Log
    * @param mixed $request
    * @param mixed $response
    * @param mixed $errorMessage
    * @param mixed $requestCustom
    */
   public static function apiLogSave($request, $response, $errorMessage = '', $requestCustom = '')
   {
      try {
         DB::beginTransaction();

         // cek apakah url tersebut API atau tidak
         if (Str::contains($request->getRequestUri(), 'api')) {
            $modulName = Str::replace('/api/', '', $request->getRequestUri());
         } else {
            $modulName = ltrim($request->getRequestUri(), '/');
         }

         $data = [
            'AppName' => 'Signify DMS Integration',
            'Modul' => $modulName,
            'Tanggal' => Carbon::now()->format('Y-m-d H:i:s.') . substr(Carbon::now()->format('u'), 0, 3),
            'Notes' => json_encode([
               'URL' => $request->fullUrl(),
               'Payloads' => $requestCustom == '' ? $request->input() : $requestCustom,
               'Response' => $response
            ], JSON_UNESCAPED_SLASHES),
            'Error_Msg' => $errorMessage == '' ? null : Str::limit(json_encode($errorMessage), 250, '...'), // error di sini makanya nggk bisa nyimpen
            'IP_Address' => $request->ip()
         ];

         $id = DB::table("API_Log")->insert($data);

         DB::commit();

         // status insert data ke API_Log
         \Log::info('API log save', ['status_insert' => $id]);
      } catch (Throwable $th) {
         DB::rollBack();

         \Log::error('something wrong', ['error' => $th->getMessage()]);
         throw $th;
      }
   }

   public static function customApiLogSave(array $dataRequest)
   {
      try {
         DB::beginTransaction();

         $data = [
            'AppName' => 'Borwita Reckitt Integration',
            'Modul' => $dataRequest['module'],
            'Tanggal' => Carbon::now()->format('Y-m-d H:i:s.') . substr(Carbon::now()->format('u'), 0, 3),
            'Notes' => json_encode([
               'URL' => $dataRequest['url'],
               'Payloads' => $dataRequest['payloads'],
               'Response' => $dataRequest['response']
            ]),
            'Error_Msg' => $dataRequest['errorMessage'], // error di sini makanya nggk bisa nyimpen
            'IP_Address' => $dataRequest['ipAddress']
         ];

         $id = DB::connection(config('database.default'))->table("API_Log")->insert($data);

         DB::commit();

         \Log::info('API log save', ['status_insert' => $id]);
      } catch (Throwable $th) {
         DB::rollBack();

         \Log::error('something wrong', ['error' => $th->getMessage()]);
         throw $th;
      }
   }

   /**
    * Summary of errorMessageWithID
    * @param \Throwable $e
    * @param mixed $saveAlogApi Digunakan untuk mengdentifikasi apakah log error perlu disimpan atau tidak
    * @param mixed $message Digunakan untuk cek apakah perlu return default atau harus melakukan return sesuai case tertentu
    * ex: pada saat mengakses API external, jika terlalu lama maka akan mereturn pesan sesuai dengan pesan yang ditambahkan
    */
   public static function errorMessageWithID(Throwable $e, $message = "Something went wrong", $showReturn = true)
   {
      $errorId = uniqid();

      $logMessage = "ErrorLogID : {$errorId} <=> " . get_class($e) . ": " . $e->getMessage()
         . "\nin " . $e->getFile() . ':' . $e->getLine() . " \n\nTrace : " . $e->getTraceAsString();

      Log::error($logMessage);

      if ($showReturn) { // cek apakah perlu return output atau tidak, default true
         return Response::internalServerError([], "{$message}, check ErrorLogID : " . $errorId);
      }
   }
}