<?php

use App\Http\Controllers\InvoiceController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/invoices', [InvoiceController::class, 'index'])->name('invoices.index');
Route::get('/invoices/open', [InvoiceController::class, 'showOpenInvoices'])->name('show.open.invoices');
Route::post('/invoices/open', [InvoiceController::class, 'approveOpenInvoices']);
Route::get('/invoices/approved', [InvoiceController::class, 'showApprovedInvoices'])->name('show.approved.invoices');
Route::post('/invoices/approved', [InvoiceController::class, 'payApprovedInvoices']);
