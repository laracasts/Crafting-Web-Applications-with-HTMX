<?php

namespace App\Http\Controllers;

use App\Helpers\HtmxHelper;
use App\Http\Responses\HtmxResponse;
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
        return $this->showInvoicesByStatus(
            InvoiceStatus::Approved, 
            'Approved Invoices',
            route('show.approved.invoices')
        );
    }

    public function showOpenInvoices() {
        return $this->showInvoicesByStatus(
            InvoiceStatus::Open, 
            'Open Invoices',
            route('show.open.invoices')
        );
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

        return redirect($request->url());
    }

    public function showInvoicesByStatus(InvoiceStatus $status, string $heading, string $postUrl) {
        $invoices = Invoice::where('status', $status)
            ->orderBy('vendor_id')
            ->orderBy('date_due', 'asc')
            ->get();

        $model = compact('heading', 'invoices', 'postUrl');

        if (!HtmxHelper::isHtmxRequest()) {
            return view('invoices.list', $model);
        }
        
        return (new HtmxResponse())
            ->addFragments('invoices.list', ['invoice-list', 'snapshots'], $model);
            // ->addFragment(
            //     'invoices.index', 
            //     'snapshots', 
            //     [], 
            //     HtmxHelper::isCurrentUrl(route('invoices.index'))
            // );
    }
}
