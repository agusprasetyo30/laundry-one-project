<?php
namespace App\Helpers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class SwitchDatabase
{
   /**
    * Switch database sesuai dengan user login
    * @param string $companyId
    * @param string $cabang
    * @return void
    */
   public static function getERPConnection(string $companyId, string $cabang)
   {
      $resultQueryErpSetting = DB::select('SELECT 
               dbName,
               ServerLocation,
               UserLogin,
               UserPassword
         FROM dbo.fnGetERPConnection (?,?)', [$companyId, $cabang]);

      if (count($resultQueryErpSetting) == 0) {
         throw new \Exception('ERP Connection not found');
      } else {
         $koneksi_cabang = collect($resultQueryErpSetting)->first();
         Config::set('database.connections.sqlsrv', array(
            'driver' => 'sqlsrv',
            'database' => $koneksi_cabang->dbName,
            'host' => $koneksi_cabang->ServerLocation,
            'username' => $koneksi_cabang->UserLogin,
            'password' => $koneksi_cabang->UserPassword,
            'trust_server_certificate' => true,
            'encrypt' => 'no'
         ));

         Config::set('database.default', 'sqlsrv');

         DB::purge('sqlsrv');
      }
   }
}