<x-layout>
    <x-section id="snapshots">
        <div class="flex items-start gap-3">
            <x-snapshot>
                <h2 class="font-title font-semibold uppercase pb-3">
                    <a 
                        hx-get="/invoices/open"
                        hx-target="#invoice-list"
                        hx-swap="outerHTML"
                        href="/invoices/open"
                    >Open Invoices</a>
                </h2>
                <p>
                    Count: {{ $openStats['count'] }}
                </p>
                <p>
                    Amount: ${{ number_format($openStats['total']) }}
                </p>
            </x-snapshot>
            <x-snapshot>
                <h2 class="font-title font-semibold uppercase pb-3">
                    <a 
                        hx-get="/invoices/approved"
                        hx-target="#invoice-list"
                        hx-swap="outerHTML"
                        href="/invoices/approved"
                    >Approved Invoices</a>
                </h2>
                <p>
                    Count: {{ $approvedStats['count'] }}
                </p>
                <p>
                    Amount: ${{ number_format($approvedStats['total']) }}
                </p>
            </x-snapshot>
        </div>
    </x-section>
    <div id="invoice-list"></div>
</x-layout>