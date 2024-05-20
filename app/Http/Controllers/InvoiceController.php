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

    public function approveOpenInvoices(Request $request) {
        return $this->setInvoicesStatus($request, InvoiceStatus::Approved);
    }

    public function payApprovedInvoices(Request $request) {
        return $this->setInvoicesStatus($request, InvoiceStatus::Paid);
    }

    public function showApprovedInvoices() {
        return $this->showInvoicesByStatus(InvoiceStatus::Approved, 'Approved Invoices');
    }

    public function showOpenInvoices() {
        return $this->showInvoicesByStatus(InvoiceStatus::Open, 'Open Invoices');
    }

    public function setInvoicesStatus(Request $request, InvoiceStatus $newStatus) {
        $all = $request->all();

        $ids = [];

        foreach ($all as $key => $value) {
            if (Str::startsWith($key, 'invoice')) {
                $ids[] = Str::substr($key, 8);
            }
        }

        Invoice::whereIn('id', $ids)
            ->update(['status' => $newStatus]);

        return redirect()->back();
    }

    public function showInvoicesByStatus(InvoiceStatus $status, string $heading) {
        $invoices = Invoice::where('status', $status)
            ->orderBy('vendor_id')
            ->orderBy('date_due', 'asc')
            ->get();

        return view('invoices.list', [
            'heading' => $heading,
            'invoices' => $invoices, 
        ]);
    }
}
