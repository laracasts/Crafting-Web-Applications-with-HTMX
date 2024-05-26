<x-layout>
    <x-section id="snapshots" x-data="{selectedId: 'none'}">
        @fragment('snapshots')
        <div id="snapshots-container" class="flex items-start gap-3" hx-swap-oob="true">
            <x-snapshot id="open-invoices-snapshot">
                <h2 class="font-title font-semibold uppercase pb-3">
                    <a 
                        hx-get="/invoices/open"
                        hx-target="#invoice-list"
                        hx-swap="outerHTML"
                        href="/invoices/open"
                        x-on:click="selectedId = $root.id"
                    >Open Invoices</a>
                </h2>
                <p>
                    Count: {{ $openStats['count'] }}
                </p>
                <p>
                    Amount: ${{ number_format($openStats['total']) }}
                </p>
            </x-snapshot>
            <x-snapshot id="approved-invoices-snapshot">
                <h2 class="font-title font-semibold uppercase pb-3">
                    <a 
                        hx-get="/invoices/approved"
                        hx-target="#invoice-list"
                        hx-swap="outerHTML"
                        href="/invoices/approved"
                        x-on:click="selectedId = $root.id"
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
        @endfragment
    </x-section>
    <div id="invoice-list"></div>
</x-layout>