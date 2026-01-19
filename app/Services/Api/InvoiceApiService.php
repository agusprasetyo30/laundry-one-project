<?php

namespace App\Services\Api;

use App\Helpers\ApiConfig;
use App\Helpers\General;
use App\Helpers\LogConfig;
use Carbon\Carbon;
use Illuminate\Support\Facades\Response;
use Str;

class InvoiceApiService
{
   /**
    * Digunakan untuk mengirim API untuk mengambil data list invoice
    * @param array $body_array
    * @return \Symfony\Component\HttpFoundation\JsonResponse
    */
   public function sendApiGetListInvoice(array $body_array)
   {
      // mengirimkan data ke API
      $getApidata = ApiConfig::sendApiRequest('get', 'invoice/get-list', $body_array);

      /// jika ingin merubah tipe ke error untuk log out
      // request()->attributes->set('log_out_data', 'error');

      // cek apakah pemanggilan data sukses atau tidak
      if ($getApidata instanceof \Illuminate\Http\JsonResponse) {
         return $getApidata;
      }

      if ($getApidata->status() >= 200 && $getApidata->status() < 300) {
         $data_api = $getApidata->json()['data'];

         // merubah output API sesuai format
         $arr_data = collect($data_api)->map(fn($item) => [
            'invoice_no' => $item['kodenota'] ?? null,
            'invoice_date' => $item['tgl'] ?? null,
            'customer_code' => $item['shipto'] ?? null,
            'customer_name' => $item['perusahaan'] ?? null,
            'segment_code' => $item['kode_segment'] ?? null,
            'segment_name' => $item['nama_segment'] ?? null,
            'salesman_code' => $item['kode_sales'] ?? null,
            'salesman_name' => $item['nama_sales'] ?? null,
            'grand_total_amount' => (double) $item['total_bayar'] ?? null,
            'remarks' => $item['keterangan'] ?? null,
            'invoice_created_at' => Carbon::createFromFormat('Y-m-d H:i:s.v', $item['create_date'])->setTimezone('UTC')->timestamp ?? null, //nanti dikurangi sesuai dengan -7
            'invoice_last_update_at' => Carbon::createFromFormat('Y-m-d H:i:s.v', $item['tgl_entry'])->setTimezone('UTC')->timestamp ?? null, //nanti dikurangi sesuai dengan -7
         ])->toArray();

         // diasumsikan epoch yang masuk adalah UTC, maka dikurangi 7
         
         LogConfig::apiLogSave(request(), $arr_data, '', $body_array);

         return Response::ok($arr_data, 'Invoice list was successfully sent');
      }

      // jika status failed
      if ($getApidata['status'] == 'failed') {
         $get_error_message = $getApidata->json()['errors'];

         // cek data, apakah errornya disebabkan oleh data partnercode atau bukan
         if (isset($get_error_message['partner_code'])) {
            $messageError = "The given data was invalid: The distributor_code data is invalid, please check the distributor_code data";

            LogConfig::apiLogSave(request(), $getApidata->json(), $messageError, $body_array);
            
            return Response::unproccessableContent(null, $messageError);
         } 
      }

      return Response::internalServerError(null, 'Something when wrong!');
   }

   /**
    * Digunakan untuk mengirim API untuk mengambil data invoice details
    * @param array $body_array
    * @return \Illuminate\Http\JsonResponse|\Symfony\Component\HttpFoundation\JsonResponse
    */
   public function sendApiGetInvoiceDetails(array $body_array)
   {
      // mengirimkan data ke API
      $getApidata = ApiConfig::sendApiRequest('post', 'invoice/get-details', $body_array);

      // cek apakah pemanggilan data sukses atau tidak
      if ($getApidata instanceof \Illuminate\Http\JsonResponse) {
         return $getApidata;
      }

      if ($getApidata->status() >= 200 && $getApidata->status() < 300) {
         $data_api = $getApidata->json()['data'];

         $arr_data = collect($data_api)
         // filter ini bersifat sementara, nanti dihapus
         ->filter(function ($row) {
            $date = Carbon::parse($row['tgl']); // sudah Y-m-d, tetap aman
            return $date->betweenIncluded(Carbon::parse('2025-07-01'), Carbon::parse('2025-07-14'));
         })
         // end filter, nanti dihapus
         ->groupBy('kodenota')->map(function ($items) {
            $header = $items->first();

            $product_details = collect($header['invoice_detail'] ?? [])->map(function ($detail) {
               return [
                  'product_code' => $detail['kode_barang'],
                  'product_name' => $detail['nama_barang'],
                  'qty' => (int) $detail['jml'],
                  'uom' => $detail['satuan'],
                  'price' => (double) $detail['harga_satuan'],
                  'disc_value' => (double) $detail['disc'],
                  'disc1_code' => $detail['ndisc1_info'],
                  'disc1_percent' => $detail['ndisc1'],
                  'disc2_code' => $detail['ndisc2_info'],
                  'disc2_percent' => $detail['ndisc2'],
                  'disc3_code' => $detail['ndisc3_info'],
                  'disc3_percent' => $detail['ndisc3'],
                  'disc4_code' => $detail['ndisc4_info'],
                  'disc4_percent' => $detail['ndisc4'],
                  'line_gross_amount' => (double) $detail['jml'] * $detail['harga_satuan'],
                  'line_disc_amount' => (double) $detail['jml'] * $detail['disc'],
                  'line_net_amount' => (double) ($detail['jml'] * $detail['harga_satuan']) - ($detail['jml'] * $detail['disc']),
               ];
            })->values();

            return [
               'invoice_no' => $header['kodenota'],
               'invoice_date' => Carbon::parse($header['tgl'])->format('Y-m-d'),
               'customer_code' => $header['shipto'],
               'customer_name' => $header['perusahaan'],
               'segment_code' => $header['kode_segment'],
               'segment_name' => $header['nama_segment'],
               'salesman_code' => $header['kode_sales'],
               'salesman_name' => $header['nama_sales'],
               'total_gross_amount' => (double) $header['total'],
               'total_disc_amount' => (double) $header['xdisc'],
               'global_dics_amount' => (double) $header['potongan'],
               'taxable_base_amount' => (double) $header['dpp'],
               'tax_percent' => (double) $header['ppn_persen_manual'],
               'tax_amount' => (double) $header['ppn'],
               'grand_total_amount' => (double) $header['total_bayar'],
               'remarks' => $header['keterangan'],
               'product_details' => $product_details
            ];
         })
         ->values();

         LogConfig::apiLogSave(request(), $arr_data, '', $body_array);

         return Response::ok($arr_data, 'Data invoice details was successfully sent');
      }

      if ($getApidata['status'] == 'failed') {
         $get_error_message = $getApidata->json()['errors'];

         // cek data, apakah errornya disebabkan oleh data partnercode atau bukan
         if (isset($get_error_message['partner_code'])) {
            $messageError = "The given data was invalid: The distributor_code data is invalid, please check the distributor_code data";

            LogConfig::apiLogSave(request(), $getApidata->json(), $getApidata->json()['errors'], $body_array);
            
            return Response::unproccessableContent(null, $messageError);
         }

         // Digunakan untuk menambahkan custom error message. case ketika invoice tidak ditemukan
         $errors_message_customer = Str::matchAll('/Invoice with number\s+.+?\s+not found/i', General::convertMessageError($get_error_message))
            ->implode(', ');
         
         LogConfig::apiLogSave(request(), $getApidata->json(), $getApidata->json()['errors'], $body_array);
         return Response::unproccessableContent(null, $errors_message_customer);
      }

      return response()->json($getApidata->json());
   }
}
