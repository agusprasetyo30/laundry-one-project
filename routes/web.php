<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index1');
})->name('index1');

Route::get('/test', function (Request $request) {
    $repo = new \App\Repositories\JabatanRepository;
    $service = new \App\Services\JabatanService;

    $pagination = $service->getPaginationParams($request);
    $filters = $service->getFiltersParams($request);
    // $data = $repo->getData($pagination['params'], $pagination['whereSearch']);
    // $data = $repo->getData([1, 10], 'nama');
    DB::enableQueryLog();
    $params = array_merge($filters['params'], [$pagination['startRow'], $pagination['endRow']]);

    $data = $repo->getData($params, $filters['whereSearch']);
    \Log::info(DB::getQueryLog());
    dd('cekData', [$pagination, $filters, $data]);
    // dd(DB::select("SELECT * FROM (
    //     SELECT ROW_NUMBER() OVER (order by nama ASC) AS RowNum, j.Nama as nama, j.Status, j.CreateDate as create_date FROM Jabatan j
    //     ) AS Result"), ['']);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/template/datatable', function () {
    return view('datatables');
})->name('template.datatable');
