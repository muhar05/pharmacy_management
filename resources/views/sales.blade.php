<x-app-layout>

    <body>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Sales') }}
            </h2>
        </x-slot>

        <main class="mt-10 w-full h-full">
            <div class="max-w-7xl mx-auto sm:px-4 lg:px-8">
                <div>
                    <h1 class="text-balance p-4 text-5xl font-semibold tracking-tight text-gray-200 sm:text-3xl">Table of
                        Sales</h1>
                    <div class="mt-6 w-full pb-6">
                        <div class="relative overflow-hidden bg-white shadow-md dark:bg-gray-800 sm:rounded-lg">
                            <div
                                class="flex flex-col px-4 py-3 space-y-3 lg:flex-row lg:items-center lg:justify-between lg:space-y-0 lg:space-x-4">
                                <div class="flex items-center flex-1 space-x-4">
                                    <h5>
                                        <span class="text-gray-500">All Products:</span>
                                        <span class="dark:text-white">123456</span>
                                    </h5>
                                    <h5>
                                        <span class="text-gray-500">Total sales:</span>
                                        <span class="dark:text-white">$88.4k</span>
                                    </h5>
                                </div>
                                <div
                                    class="flex flex-col flex-shrink-0 space-y-3 md:flex-row md:items-center lg:justify-end md:space-y-0 md:space-x-3">
                                    <button type="button"
                                        class="flex items-center justify-center px-4 py-2 text-sm font-medium text-white rounded-lg bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                                        <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                            <path clip-rule="evenodd" fill-rule="evenodd"
                                                d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                                        </svg>
                                        Add new product
                                    </button>
                                    <button type="button"
                                        class="flex items-center justify-center flex-shrink-0 px-3 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg focus:outline-none hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                                        <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
                                            fill="none" viewbox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                                        </svg>
                                        Update stocks 1/250
                                    </button>
                                    <button type="button"
                                        class="flex items-center justify-center flex-shrink-0 px-3 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg focus:outline-none hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                                        <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewbox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                            aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
                                        </svg>
                                        Export
                                    </button>
                                </div>
                            </div>
                            <div class="overflow-x-auto">
                                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                    <thead
                                        class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                        <tr>
                                            <th scope="col" class="px-4 py-3">Customer ID</th>
                                            <th scope="col" class="px-4 py-3">Employee ID</th>
                                            <th scope="col" class="px-4 py-3">Sales Date</th>
                                            <th scope="col" class="px-4 py-3">Total Amount</th>
                                            <th scope="col" class="px-4 py-3">Payment Status</th>
                                            <th scope="col" class="px-4 py-3">Created At</th>
                                            <th scope="col" class="px-4 py-3">Updated At</th>
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
                                                    <th scope="row"
                                                        class="flex items-center px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                        {{ $sale->customer_id }}
                                                    </th>
                                                    <td class="px-4 py-2">
                                                        {{ $sale->employee_id }}
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
                                                        {{ $sale->created_at }}
                                                    </td>
                                                    <td class="px-4 py-2">
                                                        {{ $sale->updated_at }}
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
    </body>
</x-app-layout>
