<?php

namespace App\Providers;

use App\InvoiceStatus;
use App\Models\Invoice;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades;
use Illuminate\View\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Facades\View::composer('components.snapshots', function(View $view) {
            $openStats = Invoice::where('status', InvoiceStatus::Open)
                ->selectRaw('COUNT(*) as count, SUM(amount_due) as total')
                ->first();

            $approvedStats = Invoice::where('status', InvoiceStatus::Approved)
                ->selectRaw('COUNT(*) as count, SUM(amount_due) as total')
                ->first();

            $view->with('openStats', $openStats);
            $view->with('approvedStats', $approvedStats);
        });
    }
}
