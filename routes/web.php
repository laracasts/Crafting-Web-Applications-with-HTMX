<?php

use App\Http\Controllers\InvoiceController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/invoices/open', [InvoiceController::class, 'showOpenInvoices']);
Route::post('/invoices/open', [InvoiceController::class, 'approveOpenInvoices']);

