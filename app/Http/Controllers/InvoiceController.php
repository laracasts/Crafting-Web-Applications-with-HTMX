<?php

namespace App\Http\Controllers;

use App\InvoiceStatus;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Ramsey\Uuid\Type\Decimal;

class InvoiceController extends Controller
{
    public function index() {
        return view('invoices.index');
    }

    public function showOpenInvoices() {

        $openInvoices = Invoice::where('status', InvoiceStatus::Open)
            ->orderBy('vendor_id')
            ->orderBy('date_due', 'asc')
            ->get();

        return view('invoices.list', [
            'heading' => 'Open Invoices',
            'invoices' => $openInvoices, 
        ]);
    }

    public function approveOpenInvoices(Request $request) {
        $all = $request->all();

        $ids = [];

        foreach ($all as $key => $value) {
            if (Str::startsWith($key, 'open')) {
                $ids[] = Str::substr($key, 5);
            }
        }

        Invoice::whereIn('id', $ids)
            ->update(['status' => InvoiceStatus::Approved]);

        return redirect('/invoices/open');
    }

    public function showApprovedInvoices() {

        $approvedInvoices = Invoice::where('status', InvoiceStatus::Approved)
            ->orderBy('vendor_id')
            ->orderBy('date_due', 'asc')
            ->get();

        return view('invoices.list', [
            'heading' => 'Approved Invoices',
            'invoices' => $approvedInvoices, 
        ]);
    }

    public function payApprovedInvoices(Request $request) {
        $all = $request->all();

        $ids = [];

        foreach ($all as $key => $value) {
            if (Str::startsWith($key, 'open')) {
                $ids[] = Str::substr($key, 5);
            }
        }

        Invoice::whereIn('id', $ids)
            ->update(['status' => InvoiceStatus::Paid]);

        return redirect('/invoices/open');
    }
}
