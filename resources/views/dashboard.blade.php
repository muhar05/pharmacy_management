<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
            data-aos="fade-down"
            data-aos-duration="800">
            Halo, {{ Auth::user()->name }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-indigo-50 to-white min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-lg sm:rounded-xl bg-white dark:bg-gray-900 transition-all duration-300"
                data-aos="fade-up"
                data-aos-duration="900">
                <div class="p-8 text-gray-900 dark:text-gray-100">
                    <div class="container mx-auto px-4 py-8">
                        <h2 class="text-3xl font-bold mb-8 text-indigo-700 dark:text-indigo-300 text-center"
                            data-aos="fade-right"
                            data-aos-duration="900">
                            Fitur Utama Apotech Management
                        </h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10"
                            data-aos="zoom-in"
                            data-aos-duration="900">
                            <a href="{{ route('cashier') }}"
                                class="flex flex-col items-center justify-center p-6 rounded-xl dark:bg-gray-800 dark:hover:bg-gray-700 bg-indigo-100 hover:bg-indigo-200 cursor-pointer shadow transition-all duration-200 group">
                                <svg class="w-12 h-12 text-indigo-600 group-hover:scale-110 transition-transform duration-200" aria-hidden="true"
                                    fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M5 4h1.5L9 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-8.5-3h9.25L19 7H7.312" />
                                </svg>
                                <h3 class="mt-4 text-lg font-semibold text-indigo-800 dark:text-indigo-200">Kasir</h3>
                                <span class="text-sm text-gray-500 dark:text-gray-400 mt-2 text-center">Transaksi penjualan obat dengan mudah dan cepat.</span>
                            </a>
                            <a href="{{ route('sales') }}"
                                class="flex flex-col items-center justify-center p-6 rounded-xl dark:bg-gray-800 dark:hover:bg-gray-700 bg-indigo-100 hover:bg-indigo-200 cursor-pointer shadow transition-all duration-200 group">
                                <svg class="w-12 h-12 text-indigo-600 group-hover:scale-110 transition-transform duration-200" aria-hidden="true"
                                    fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M10 3v4a1 1 0 0 1-1 1H5m8-2h3m-3 3h3m-4 3v6m4-3H8M19 4v16a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V7.914a1 1 0 0 1 .293-.707l3.914-3.914A1 1 0 0 1 9.914 3H18a1 1 0 0 1 1 1ZM8 12v6h8v-6H8Z" />
                                </svg>
                                <h3 class="mt-4 text-lg font-semibold text-indigo-800 dark:text-indigo-200">Statistik Penjualan</h3>
                                <span class="text-sm text-gray-500 dark:text-gray-400 mt-2 text-center">Lihat grafik dan data penjualan apotek Anda.</span>
                            </a>
                        </div>
                        <div class="w-full dark:bg-slate-800 bg-slate-100 mt-10 rounded-xl shadow"
                            data-aos="fade-up"
                            data-aos-duration="900">
                            <div class="w-full flex flex-wrap p-5 justify-center items-center gap-6">
                                <form action="{{ route('dashboard') }}" method="GET" class="flex gap-2">
                                    <button name="period" value="daily"
                                        class="p-3 rounded-lg font-semibold transition-all duration-200 {{ $period === 'daily' ? 'bg-blue-600 text-white border-2 border-blue-800 shadow-lg scale-105' : 'bg-slate-300 dark:bg-slate-800 dark:text-white hover:bg-slate-400 hover:dark:bg-slate-700' }}">
                                        Harian
                                    </button>
                                    <button name="period" value="weekly"
                                        class="p-3 rounded-lg font-semibold transition-all duration-200 {{ $period === 'weekly' ? 'bg-green-600 text-white border-2 border-green-800 shadow-lg scale-105' : 'bg-slate-300 dark:bg-slate-800 dark:text-white hover:bg-slate-400 hover:dark:bg-slate-700' }}">
                                        Mingguan
                                    </button>
                                    <button name="period" value="monthly"
                                        class="p-3 rounded-lg font-semibold transition-all duration-200 {{ $period === 'monthly' ? 'bg-red-600 text-white border-2 border-red-800 shadow-lg scale-105' : 'bg-slate-300 dark:bg-slate-800 dark:text-white hover:bg-slate-400 hover:dark:bg-slate-700' }}">
                                        Bulanan
                                    </button>
                                </form>
                            </div>
                            <div class="w-full p-6 grid grid-cols-1 md:grid-cols-3 gap-6 justify-center items-center text-center">
                                <div class="flex flex-col items-center bg-white dark:bg-gray-900 rounded-lg p-4 shadow"
                                    data-aos="fade-up"
                                    data-aos-duration="900">
                                    <h1 class="font-semibold text-lg text-indigo-700 dark:text-indigo-300">Total Penjualan</h1>
                                    <h2 id="totalSales" class="font-bold text-2xl mt-2 text-gray-800 dark:text-white">
                                        {{ $totalSales }}</h2>
                                </div>
                                <div class="flex flex-col items-center bg-white dark:bg-gray-900 rounded-lg p-4 shadow"
                                    data-aos="fade-up"
                                    data-aos-duration="900"
                                    data-aos-delay="100">
                                    <h1 class="font-semibold text-lg text-indigo-700 dark:text-indigo-300">Transaksi</h1>
                                    <h2 id="transactionCount" class="font-bold text-2xl mt-2 text-gray-800 dark:text-white">{{ $transactionCount }}</h2>
                                </div>
                                <div class="flex flex-col items-center bg-white dark:bg-gray-900 rounded-lg p-4 shadow"
                                    data-aos="fade-up"
                                    data-aos-duration="900"
                                    data-aos-delay="200">
                                    <h1 class="font-semibold text-lg text-indigo-700 dark:text-indigo-300">Best Seller</h1>
                                    <h2 id="bestSeller" class="font-bold text-2xl mt-2 text-gray-800 dark:text-white">{{ $bestSeller }}</h2>
                                </div>
                            </div>
                        </div>
                        <div class="w-full mt-10 flex flex-col md:flex-row justify-center gap-6 items-start"
                            data-aos="fade-up"
                            data-aos-duration="900">
                            <div class="w-full md:w-1/2 p-6 bg-white dark:bg-gray-900 rounded-xl shadow flex-1">
                                <h1 class="font-semibold text-lg text-indigo-700 dark:text-indigo-300 mb-2">Stok Rendah</h1>
                                <ul class="grid grid-cols-1 sm:grid-cols-2 gap-2 p-2 list-disc ml-4">
                                    @forelse ($lowStockMedicines as $medicine)
                                        <li>{{ $medicine->name }} <span class="text-xs text-red-500">(Stock: {{ $medicine->stock }})</span></li>
                                    @empty
                                        <li class="text-gray-500">Semua stok aman</li>
                                    @endforelse
                                </ul>
                            </div>
                            <div class="w-full md:w-1/2 p-6 bg-white dark:bg-gray-900 rounded-xl shadow flex-1">
                                <h1 class="font-semibold text-lg text-indigo-700 dark:text-indigo-300 mb-2">Kadaluarsa dalam 30 hari</h1>
                                <ul class="grid grid-cols-1 sm:grid-cols-2 gap-2 p-2 list-disc ml-4">
                                    @forelse ($expiringMedicines as $medicine)
                                        <li>{{ $medicine->name }} <span class="text-xs text-orange-500">(Exp: {{ $medicine->formatted_expiry_date }})</span></li>
                                    @empty
                                        <li class="text-gray-500">Tidak ada obat kadaluarsa</li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Tambahkan AOS JS jika belum ada di layout -->
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
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
