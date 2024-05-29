<x-layout>
    <x-snapshots></x-snapshots>
    @fragment('invoice-list')
    <x-section id="invoice-list" :$heading 
        hx-post="{{ $postUrl }}"
        hx-include="form#invoice-form input"
        hx-trigger="click from:button#submit-button"
        hx-target="#invoice-list"
        hx-swap="outerHTML"
        x-data="invoiceList"
    >
        <form id="invoice-form" method="POST" action="{{ $postUrl }}" onsubmit="return false">
            @csrf
            <div class="flex justify-between items-center">
                <button
                    id="submit-button"
                    class="flex items-center justify-center border border-transparent bg-primary px-10 py-3 font-title font-bold uppercase transition-colors duration-300 hover:bg-primary-highlight focus:outline-0 focus:ring-1 focus:ring-alternate disabled:bg-gray-500"
                    type="submit"
                    x-bind:disabled="count == 0"
                >Submit</button>
                <span class="inline-block" x-text="formatTotal"></span>
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
                        <tr 
                            x-data="{selected: false}"
                            x-init="$watch('selected', value => change(value, {{ $invoice->amount_due }}) )"
                            class="text-left py-3 px-4 *:py-3 *:px-2 has-[td]:hover:bg-gray-700 duration-300">
                            <td>
                                <input 
                                    type="checkbox" 
                                    name="invoice:{{ $invoice->id }}"
                                    x-model="selected"
                                >
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
    @endfragment
</x-layout>




