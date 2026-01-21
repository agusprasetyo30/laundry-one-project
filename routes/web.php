<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\LandingPageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', [LandingPageController::class, 'index'])
    ->name('index');

Route::get('/test', function (Request $request, \App\Services\PromoService $promoService) {
    $expirePromo = $promoService->getPromoExpiration();
    dd($expirePromo);

    // $repo = new \App\Repositories\JabatanRepository;
    // $service = new \App\Services\JabatanService;

    // $pagination = $service->getPaginationParams($request);
    // $filters = $service->getFiltersParams($request);
    // // $data = $repo->getData($pagination['params'], $pagination['whereSearch']);
    // // $data = $repo->getData([1, 10], 'nama');
    // DB::enableQueryLog();
    // $params = array_merge($filters['params'], [$pagination['startRow'], $pagination['endRow']]);

    // $data = $repo->getData($params, $filters['whereSearch']);
    // \Log::info(DB::getQueryLog());
    // dd('cekData', [$pagination, $filters, $data]);
    // dd(DB::select("SELECT * FROM (
    //     SELECT ROW_NUMBER() OVER (order by nama ASC) AS RowNum, j.Nama as nama, j.Status, j.CreateDate as create_date FROM Jabatan j
    //     ) AS Result"), ['']);
});

Route::get('/template/datatable', function () {
    return view('datatables');
})->name('template.datatable');

// Blog Routes
Route::get('/blog', [\App\Http\Controllers\BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [\App\Http\Controllers\BlogController::class, 'show'])->name('blog.show');

// Hubungi Kami Route
Route::get('/hubungi-kami', function () {
    return view('landing-page.contact');
})->name('hubungi-kami');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::prefix('/admin')->as('admin.')->namespace('Admin')->group(function () {
    Route::get('/', function () {
        return view('datatables');
    })->name('index');

    Route::get('/pengguna', [UserController::class, 'index'])->name('user.index');
    // Route::get('/login', function () {
    //     return view('admin.login');
    // })->name('admin.login');
});
