<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class JabatanRepository {
   public function getData(array $params, string $whereSearch) {
      $query = "
            SELECT * FROM (
               {$this->queryString($whereSearch)}
            ) AS RawResult
         WHERE RowNum BETWEEN ? AND ?";
         \Log::info($query);
      return DB::select($query, $params);
   }

   private function queryString(string $whereString = '') {
      $whereString = $whereString ? "WHERE {$whereString}" : '';

      return "SELECT 
            ROW_NUMBER() OVER (order by j.Nama ASC) AS RowNum,
            j.*
         FROM 
            Jabatan j {$whereString}";
   }
}