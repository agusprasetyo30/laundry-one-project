<?php

namespace App\Services;

use Illuminate\Http\Request;

class JabatanService {
   /**
    * Summary of getPaginationParams
    * @param Request $request
    * @return array{endRow: float|int, limit: mixed, page: mixed, startRow: float|int}
    */
   public function getPaginationParams(Request $request) {
      $page = $request->get('page', 1);
      $limit = $request->get('limit', 100); // ambil 100-an record per load

      return [
         'page'     => $page,
         'limit'    => $limit,
         'startRow' => ($page - 1) * $limit + 1,
         'endRow'   => $page + $limit - 1
      ];
   }

   public function getFiltersParams(Request $request) {
      $search = $request->input('search');
      // Jika terdapat filter tanggal
      $startDate = $request->input('startDate');
      $endDate = $request->input('endDate');

      $params = [];

      // Menampung semua seaching
      $whereSearch = $this->buildSearchConditions($search, $params);
      $dateFilter = $this->buildDateFilter($startDate, $endDate, $params);

      return [
         'whereSearch' => $whereSearch,
         'params' => $params,
      ];
   }

   /**
    * Digunakan untuk membuild pencarian berdasarkan query
   * @param mixed $search
   * @param array $params
   * @return string
   */
   public function buildSearchConditions($search, &$params) {
      if(empty($search)) {
         return '';
      }

      $whereSearch = "j.Nama LIKE ?";
      // $whereSearch = "";
         
      for ($i = 0; $i < 1; $i++) {
         $params[] = "%$search%";
      }

      return $whereSearch;
   }

   /**
    * Digunakan untuk memfilter tanggal pada query yang nantinya dimasukan kedalam query
    * @param mixed $startDate
    * @param mixed $endDate
    * @param array $params
    */
   public function buildDateFilter(?string $startDate, ?string $endDate, array &$params): string  {
      // fill data to array
      $params[] = "{$startDate}";
      $params[] = "{$endDate}";
   
      return $startDate && $endDate ? " AND j.CreateDate BETWEEN ? AND ?" : '';
   }
}