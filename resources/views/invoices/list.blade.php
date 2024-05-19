<x-layout>
    <x-section id="snapshots">
        <div class="grid items-start md:grid-cols-2 gap-3">
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
    <x-section id="invoice-list" :$heading>
        <form method="POST" action="">
            @csrf
            <div>
                <button
                    class="flex items-center justify-center border border-transparent bg-primary px-10 py-3 font-title font-bold uppercase transition-colors duration-300 hover:bg-primary-highlight focus:outline-0 focus:ring-1 focus:ring-alternate disabled:bg-gray-500"
                type="submit">Submit</button>
            </div>
            <div class="bg-gray-800 p-3 mt-4 mb-4 px-4 py-4">
                <table class="w-full">
                    <thead class="border-b border-white/10 font-title font-semibold uppercase">
                        <tr class="text-left py-3 px-4 *:py-3 *:px-2 has-[td]:hover:bg-gray-700 duration-300">
                            <th></th>
                            <th>
                                Vendor
                            </th>
                            <th>
                                Invoice Number
                            </th>
                            <th class="text-right">
                                Invoice Date
                            </th>
                            <th class="text-right">
                                Due Date
                            </th>
                            <th class="text-right">
                                Amount Due
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/10 even:*:bg-black/5">
                        @foreach ($invoices as $invoice)
                        <tr class="text-left py-3 px-4 *:py-3 *:px-2 has-[td]:hover:bg-gray-700 duration-300">
                            <td>
                                <input type="checkbox" name="open:{{ $invoice->id }}">
                            </td>
                            <td>
                                {{ $invoice->vendor->name }}
                            </td>
                            <td>
                                {{ $invoice->invoice_number }}
                            </td>
                            <td class="text-right">
                                {{ $invoice->invoice_date }}
                            </td>
                            <td class="text-right">
                                {{ $invoice->date_due }}
                            </td>
                            <td class="text-right">
                                ${{ number_format($invoice->amount_due,2) }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </form>
    </x-section>
</x-layout>




