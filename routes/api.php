<?php

use App\Http\Controllers\Invoices\InvoiceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/getAllInvoice',[InvoiceController::class,'getAllInvoice'])->name('get.invoices');
Route::get('/searchInvoice',[InvoiceController::class,'searchInvoice'])->name('search.invoice');
Route::get('/new-invoice',\App\Http\Controllers\Invoices\NewInvoiceController::class)->name('new.invoice');
Route::get('/all-customers',[InvoiceController::class,'getAllCustomers'])->name('all.customers');
Route::get('/all-products',[InvoiceController::class,'getAllProducts'])->name('all.products');
Route::post('/add-invoice',\App\Http\Controllers\invoices\AddInvoiceController::class)->name('add.invoice');
Route::get('/show-invoice/{id}',[InvoiceController::class,'getInvoice'])->name('get.invoice');
