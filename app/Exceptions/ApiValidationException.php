<?php

namespace App\Exceptions;

use App\Helpers\General;
use App\Helpers\LogConfig;
use App\Helpers\SwitchDatabase;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Str;

class ApiValidationException extends HttpResponseException
{
    protected $code = 422;

    public function __construct($validator, $message = "Validation failed")
    {
        parent::__construct( Response::unproccessableContent(null, $message));

        $this->loggingInOut($validator);
        $this->saveApiLog(request(), $validator);
    }

    private function loggingInOut($validator) {
        LogConfig::logRequestInOut(request(), request()->input());
        LogConfig::logRequestInOut(request(), [$validator->errors()->toArray()], 'OUT', 'error');
    }

    
    private function saveApiLog(Request $request, Validator $validator) {
        $kodeCabangDivisi = '';

        if(session()->has('user_login')) {
            $kodeCabangDivisi = session('user_login')['Cabang'] ?? '';
        } else {
            // NOTE: untuk sementara mengambil data input 'distributor_code' dari request
            // mungkin jika ada konfigurasi lain bisa diubah / disesuikan
            $kodeCabangDivisi = request()->input('distributor_code') . "/" . config('microservice.kode_signify');
        }

        if (request()->input('distributor_code') != '') {
            SwitchDatabase::getERPConnection(config('microservice.company_id'),$kodeCabangDivisi);
            
            LogConfig::apiLogSave($request, $validator->errors()->toArray(), $validator->errors()->toArray());
        }
    }
}
