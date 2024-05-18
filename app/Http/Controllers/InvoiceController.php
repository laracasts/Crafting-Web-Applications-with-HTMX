<?php

namespace App\Http\Controllers;

use App\InvoiceStatus;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Ramsey\Uuid\Type\Decimal;

class InvoiceController extends Controller
{
    public function showOpenInvoices() {

        $openInvoices = Invoice::where('status', InvoiceStatus::Open)
            ->orderBy('vendor_id')
            ->orderBy('date_due', 'asc')
            ->get();

        $approvedStats = Invoice::where('status', InvoiceStatus::Approved)
            ->selectRaw('COUNT(*) as count, SUM(amount_due) as total')
            ->first();

        $openStats = [
            'count' => $openInvoices->count(),
            'total' => $openInvoices->reduce(function ($carry, $item) {
                return $carry + $item->amount_due;
            }, 0)
        ];

        return view('invoices.list', [
            'heading' => 'Open Invoices',
            'invoices' => $openInvoices, 
            'openStats' => $openStats, 
            'approvedStats' => $approvedStats
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

        $openStats = Invoice::where('status', InvoiceStatus::Open)
            ->selectRaw('COUNT(*) as count, SUM(amount_due) as total')
            ->first();

        $approvedStats = [
            'count' => $approvedInvoices->count(),
            'total' => $approvedInvoices->reduce(function ($carry, $item) {
                return $carry + $item->amount_due;
            }, 0)
        ];

        return view('invoices.list', [
            'heading' => 'Approved Invoices',
            'invoices' => $approvedInvoices, 
            'openStats' => $openStats, 
            'approvedStats' => $approvedStats
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
