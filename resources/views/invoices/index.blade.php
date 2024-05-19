<x-layout>
    <x-section id="snapshots">
        <div class="flex items-start gap-3">
            <x-snapshot>
                <h2 class="font-title font-semibold uppercase pb-3">
                    <a href="/invoices/open">Open Invoices</a>
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
                    <a href="/invoices/approved">Approved Invoices</a>
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
</x-layout>