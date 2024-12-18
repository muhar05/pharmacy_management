<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Halo, {{ Auth::user()->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="container mx-auto px-4 py-8">
                        <h2 class="text-2xl font-bold mb-6">
                            Feature of Apotech Management
                        </h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-4">
                            <a href="{{ route('cashier') }}"
                                class="flex flex-col items-center justify-center p-4 rounded-lg dark:bg-gray-800 dark:hover:bg-gray-700 bg-slate-300 hover:bg-slate-400 cursor-pointer">
                                <svg class="w-[36px] h-[36px] text-gray-800 dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                    viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M5 4h1.5L9 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-8.5-3h9.25L19 7H7.312" />
                                </svg>
                                <h3 class="mt-2 text-lg font-semibold">Cashier</h3>
                            </a>
                            <a href="{{ route('sales') }}"
                                class="flex flex-col items-center justify-center p-4 rounded-lg dark:bg-gray-800 dark:hover:bg-gray-700 bg-slate-300 hover:bg-slate-400 cursor-pointer">
                                <svg class="w-[36px] h-[36px] text-gray-800 dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                    viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M10 3v4a1 1 0 0 1-1 1H5m8-2h3m-3 3h3m-4 3v6m4-3H8M19 4v16a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V7.914a1 1 0 0 1 .293-.707l3.914-3.914A1 1 0 0 1 9.914 3H18a1 1 0 0 1 1 1ZM8 12v6h8v-6H8Z" />
                                </svg>
                                <h3 class="mt-2 text-lg font-semibold">Sales Statistics</h3>
                            </a>
                        </div>
                        <div class="w-full dark:bg-slate-800 bg-slate-200 mt-10 rounded-lg">
                            <div class="w-full flex p-5 justify-start items-center gap-6">
                                <form action="{{ route('dashboard') }}" method="GET" class="flex gap-2">
                                    <button name="period" value="daily"
                                        class="p-3 rounded-lg transition-all duration-200 {{ $period === 'daily' ? 'bg-blue-600 text-white border-2 border-blue-800 shadow-lg scale-105' : 'bg-slate-300 dark:bg-slate-800 dark:text-white hover:bg-slate-400 hover:dark:bg-slate-700' }}">
                                        Daily
                                    </button>
                                    <button name="period" value="weekly"
                                        class="p-3 rounded-lg transition-all duration-200 {{ $period === 'weekly' ? 'bg-green-600 text-white border-2 border-green-800 shadow-lg scale-105' : 'bg-slate-300 dark:bg-slate-800 dark:text-white hover:bg-slate-400 hover:dark:bg-slate-700' }}">
                                        Weekly
                                    </button>
                                    <button name="period" value="monthly"
                                        class="p-3 rounded-lg transition-all duration-200 {{ $period === 'monthly' ? 'bg-red-600 text-white border-2 border-red-800 shadow-lg scale-105' : 'bg-slate-300 dark:bg-slate-800 dark:text-white hover:bg-slate-400 hover:dark:bg-slate-700' }}">
                                        Monthly
                                    </button>
                                </form>
                            </div>
                            <div class="w-full p-6 grid grid-cols-2 gap-5 justify-center items-center text-center">
                                <div class="w-full flex flex-col justify-between col-span-2">
                                    <h1 class="font-semibold text-xl">Sum of Sales : </h1>
                                    <h2 id="totalSales" class="font-semibold text-3xl">
                                        {{ $totalSales }}</h2>
                                </div>
                                <div class="w-full flex flex-col justify-between">
                                    <h1 class="font-semibold text-xl">Transaction : </h1>
                                    <h2 id="transactionCount" class="font-semibold text-3xl">{{ $transactionCount }}
                                    </h2>
                                </div>
                                <div class="w-full flex flex-col justify-between">
                                    <h1 class="font-semibold text-xl">Best Seller : </h1>
                                    <h2 id="bestSeller" class="font-semibold text-3xl">{{ $bestSeller }}</h2>
                                </div>
                            </div>
                        </div>
                        <div class="w-full mt-10 flex justify-center gap-5 items-star">
                            <div class="w-full p-4 bg-slate-200 dark:bg-slate-800 rounded-lg flex-1">
                                <h1 class="font-semibold text-lg">Stok Rendah</h1>
                                <ul class="grid grid-cols-3 gap-4 p-2 list-disc">
                                    @foreach ($lowStockMedicines as $medicine)
                                        <li>{{ $medicine->name }} (Stock: {{ $medicine->stock }})</li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="w-full p-4 bg-slate-200 dark:bg-slate-800 rounded-lg flex-1">
                                <h1 class="font-semibold text-lg">Kadaluarsa dalam 30 hari</h1>
                                <ul class="grid grid-cols-3 gap-4 p-2 list-disc">
                                    @foreach ($expiringMedicines as $medicine)
                                        <li>{{ $medicine->name }} (Exp: {{ $medicine->formatted_expiry_date }})</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('button[name="period"]').on('click', function(e) {
                e.preventDefault(); // Prevent the default form submission

                var period = $(this).val(); // Get the selected period

                // Remove active classes from all buttons
                $('button[name="period"]').removeClass(
                        'bg-blue-600 bg-green-600 bg-red-600 text-white border-2 border-blue-800 border-green-800 border-red-800 shadow-lg scale-105'
                    )
                    .addClass(
                        'bg-slate-300 dark:bg-slate-800 dark:text-white hover:bg-slate-400 hover:dark:bg-slate-700'
                    );

                // Add active class to the clicked button
                if (period === 'daily') {
                    $(this).removeClass(
                            'bg-slate-300 dark:bg-slate-800 dark:text-white hover:bg-slate-400 hover:dark:bg-slate-700'
                        )
                        .addClass('bg-blue-600 text-white border-2 border-blue-800 shadow-lg scale-105');
                } else if (period === 'weekly') {
                    $(this).removeClass(
                            'bg-slate-300 dark:bg-slate-800 dark:text-white hover:bg-slate-400 hover:dark:bg-slate-700'
                        )
                        .addClass('bg-blue-600 text-white border-2 border-blue-800 shadow-lg scale-105');
                } else if (period === 'monthly') {
                    $(this).removeClass(
                            'bg-slate-300 dark:bg-slate-800 dark:text-white hover:bg-slate-400 hover:dark:bg-slate-700'
                        )
                        .addClass('bg-blue-600 text-white border-2 border-blue-800 shadow-lg scale-105');
                }

                // AJAX request to fetch data
                $.ajax({
                    url: '{{ route('dashboard') }}',
                    method: 'GET',
                    data: {
                        period: period
                    },
                    success: function(data) {
                        if (data.totalSales !== undefined) {
                            $('#totalSales').text(data.totalSales);
                        }
                        if (data.transactionCount !== undefined) {
                            $('#transactionCount').text(data.transactionCount);
                        }
                        if (data.bestSeller !== undefined) {
                            $('#bestSeller').text(data.bestSeller);
                        }
                    },
                    error: function(xhr) {
                        console.error(xhr);
                    }
                });
            });
        });
    </script>
</x-app-layout>
