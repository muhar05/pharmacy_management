<x-app-layout>

    <body>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-300 leading-tight">
                {{ __('Sales') }}
            </h2>
        </x-slot>

        <main class="mt-10 w-full h-full">
            <div class="max-w-7xl mx-auto sm:px-4 lg:px-8">
                <div>
                    <h1 class="text-balance p-4 text-5xl font-semibold tracking-tight dark:text-gray-200 sm:text-3xl">
                        Table of
                        Sales</h1>
                    <div class="mt-6 w-full pb-6">
                        <div class="relative overflow-hidden bg-white shadow-md dark:bg-gray-800 sm:rounded-lg">
                            <div
                                class="flex flex-col px-4 py-3 space-y-3 lg:flex-row lg:items-center lg:justify-between lg:space-y-0 lg:space-x-4">
                                <div class="flex items-center flex-1 space-x-4">
                                    <h5>
                                        <span class="text-gray-500">All Products:</span>
                                        <span class="dark:text-white">{{ $totalMedicineRows }}</span>
                                    </h5>
                                    <h5>
                                        <span class="text-gray-500">Total sales:</span>
                                        <span
                                            class="dark:text-white">{{ 'Rp ' . number_format($totalSales, 0, ',', '.') }}</span>
                                    </h5>
                                </div>
                                <div
                                    class="flex flex-col flex-shrink-0 space-y-3 md:flex-row md:items-center lg:justify-end md:space-y-0 md:space-x-3">
                                    <button id="actionsDropdownButton" data-dropdown-toggle="actionsDropdown"
                                        class="w-full md:w-auto flex items-center justify-center py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"
                                        type="button">
                                        <svg class="-ml-1 mr-1.5 w-5 h-5" fill="currentColor" viewbox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                            <path clip-rule="evenodd" fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                                        </svg>
                                        Actions
                                    </button>
                                    <div id="actionsDropdown"
                                        class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                                        <ul class="py-1 text-sm text-gray-700 dark:text-gray-200"
                                            aria-labelledby="actionsDropdownButton">
                                            <li>
                                                <a href="{{ route('sales.export-xlsx') }}"
                                                    class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                                                    Export XLSX
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ route('sales.export-pdf') }}"
                                                    class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                                                    Export PDF
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="overflow-x-auto">
                                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                    <thead
                                        class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                        <tr>
                                            <th scope="col" class="px-4 py-3">Customer ID</th>
                                            <th scope="col" class="px-4 py-3">Customer Name</th>
                                            <th scope="col" class="px-4 py-3">Sales Date</th>
                                            <th scope="col" class="px-4 py-3">Total Amount</th>
                                            <th scope="col" class="px-4 py-3">Payment Status</th>
                                            <th scope="col" class="px-4 py-3">Created At</th>
                                            <th scope="col" class="px-4 py-3">Updated At</th>
                                            <th scope="col" class="px-4 py-3">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($sales->isEmpty())
                                            <tr>
                                                <td colspan="7"
                                                    class="px-4 py-2 text-center text-gray-500 dark:text-gray-400">
                                                    Tidak ada data penjualan.
                                                </td>
                                            </tr>
                                        @else
                                            @foreach ($sales as $sale)
                                                <tr
                                                    class="border-b dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700">
                                                    <td class="px-4 py-2 flex justify-center items-center">
                                                        {{ $sale->customer_id }}
                                                    </td>
                                                    <td class="px-4 py-2 text-lg dark:text-white">
                                                        {{ optional($sale->customer)->name ?? 'No Customer' }}
                                                    </td>
                                                    <td class="px-4 py-2">
                                                        <span
                                                            class="bg-primary-100 text-primary-800 text-xs font-medium px-2 py-0.5 rounded dark:bg-primary-900 dark:text-primary-300">{{ $sale->sale_date }}</span>
                                                    </td>
                                                    <td
                                                        class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                        <div class="flex items-center">
                                                            <div
                                                                class="inline-block w-4 h-4 mr-2 bg-red-700 rounded-full">
                                                            </div>
                                                            {{ 'Rp ' . number_format($sale->total_amount, 0, ',', '.') }}
                                                        </div>
                                                    </td>
                                                    <td
                                                        class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                        {{ $sale->payment_status }}</td>
                                                    <td class="px-4 py-2">
                                                        {{ $sale->updated_at->diffForHumans() }}
                                                    </td>
                                                    <td class="px-4 py-2">
                                                        {{ $sale->updated_at->diffForHumans() }}
                                                    </td>
                                                    <td class="px-4 py-4 flex flex-row gap-4">
                                                        <button x-data
                                                            x-on:click.prevent="
                                                                            $dispatch('open-modal', 'edit-sale-modal');
                                                                            $dispatch('set-sale-data', {
                                                                                id: {{ $sale->id }},
                                                                                customer_name: '{{ $sale->customer->name }}',
                                                                                payment_status: '{{ $sale->payment_status }}',
                                                                                sale_date: '{{ $sale->sale_date }}'
                                                                            })
                                                                        "
                                                            class="text-white bg-yellow-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-1 py-1 text-center dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-yellow-800">Edit</button>
                                                        <button x-data=""
                                                            x-on:click.prevent="$dispatch('open-modal', 'delete-sale-modal');
                                                                    $dispatch('set-sale-data', {
                                                                        id: {{ $sale->id }},
                                                                    })"
                                                            class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-1 py-1 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Delete</button>
                                                        <a class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-1 py-1 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                                            href="{{ route('sale.detail', $sale->id) }}">View
                                                            Details</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        @include('sales.modalDelete')
        @include('sales.modalEdit')
    </body>
</x-app-layout>
