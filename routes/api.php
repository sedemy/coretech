<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\InvoiceController;
use Illuminate\Support\Facades\Route;

/*
 * |--------------------------------------------------------------------------
 * | API Routes
 * |--------------------------------------------------------------------------
 * |
 * | Here is where you can register API routes for your application. These
 * | routes are loaded by the RouteServiceProvider and all of them will
 * | be assigned to the "api" middleware group. Make something great!
 * |
 */

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/login', [AuthController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/contracts/{contract}/invoices', [InvoiceController::class, 'create']);

    Route::get('/contracts/{contract}/invoices', [InvoiceController::class, 'invoicesList']);

    Route::get('/invoices/{invoice}', [InvoiceController::class, 'invoiceDetails']);

    Route::get('/contracts/{contract}/summary', [InvoiceController::class, 'contractSummary']);

    Route::post('/invoices/{invoice}/payments', [InvoiceController::class, 'recordPayment']);
});
