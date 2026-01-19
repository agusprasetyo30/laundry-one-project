<?php

use App\Http\Controllers\Api\InvoiceController;
use Illuminate\Support\Facades\Route;

Route::get('/', function() {
    return response()->json(['message' => 'Welcome to API integration']);
});

// Route::group(['namespace' => 'App\Http\Controllers\Api', 'middleware' => ['basic.auth']], function () {
//     Route::prefix('/invoice')->as('invoice.')->group(function() {
//         Route::get('/get-list', [InvoiceController::class, 'getInvoiceList'])->name('get-list')->middleware(['log.inout']);
//         Route::get('/get-details', [InvoiceController::class, 'getInvoiceDetails'])->name('get-details')->middleware(['log.inout']);
//     });
// });