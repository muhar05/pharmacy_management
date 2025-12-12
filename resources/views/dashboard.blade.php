<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight" data-aos="fade-down"
            data-aos-duration="800">
            Halo, {{ Auth::user()->name }}
        </h2>
    </x-slot>

    <div class="bg-gradient-to-br from-indigo-50 to-white min-h-screen">
        <div class="max-w-full mx-auto">
            <div class="overflow-hidden shadow-lg bg-white dark:bg-gray-900 transition-all duration-300">
                <div class="p-8 text-gray-900 dark:text-gray-100">
                    <div class="container mx-auto px-4 py-8">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10" data-aos="zoom-in"
                            data-aos-duration="900">
                            <a href="{{ route('cashier') }}"
                                class="flex flex-col items-center justify-center p-6 rounded-xl dark:bg-gray-800 dark:hover:bg-gray-700 bg-indigo-100 hover:bg-indigo-200 cursor-pointer shadow transition-all duration-200 group">
                                <svg class="w-12 h-12 text-indigo-600 group-hover:scale-110 transition-transform duration-200"
                                    aria-hidden="true" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M5 4h1.5L9 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-8.5-3h9.25L19 7H7.312" />
                                </svg>
                                <h3 class="mt-4 text-lg font-semibold text-indigo-800 dark:text-indigo-200">Kasir</h3>
                                <span class="text-sm text-gray-500 dark:text-gray-400 mt-2 text-center">Transaksi
                                    penjualan obat dengan mudah dan cepat.</span>
                            </a>
                            <a href="{{ route('sales') }}"
                                class="flex flex-col items-center justify-center p-6 rounded-xl dark:bg-gray-800 dark:hover:bg-gray-700 bg-indigo-100 hover:bg-indigo-200 cursor-pointer shadow transition-all duration-200 group">
                                <svg class="w-12 h-12 text-indigo-600 group-hover:scale-110 transition-transform duration-200"
                                    aria-hidden="true" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M10 3v4a1 1 0 0 1-1 1H5m8-2h3m-3 3h3m-4 3v6m4-3H8M19 4v16a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V7.914a1 1 0 0 1 .293-.707l3.914-3.914A1 1 0 0 1 9.914 3H18a1 1 0 0 1 1 1ZM8 12v6h8v-6H8Z" />
                                </svg>
                                <h3 class="mt-4 text-lg font-semibold text-indigo-800 dark:text-indigo-200">Statistik
                                    Penjualan</h3>
                                <span class="text-sm text-gray-500 dark:text-gray-400 mt-2 text-center">Lihat grafik dan
                                    data penjualan apotek Anda.</span>
                            </a>
                        </div>
                        <div class="w-full dark:bg-slate-800 bg-slate-100 mt-10 rounded-xl shadow" data-aos="fade-up"
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
                            <div
                                class="w-full p-6 grid grid-cols-1 md:grid-cols-3 gap-6 justify-center items-center text-center">
                                <div class="flex flex-col items-center bg-white dark:bg-gray-900 rounded-lg p-4 shadow"
                                    data-aos="fade-up" data-aos-duration="900">
                                    <h1 class="font-semibold text-lg text-indigo-700 dark:text-indigo-300">Total
                                        Penjualan</h1>
                                    <h2 id="totalSales" class="font-bold text-2xl mt-2 text-gray-800 dark:text-white">
                                        {{ $totalSales }}</h2>
                                </div>
                                <div class="flex flex-col items-center bg-white dark:bg-gray-900 rounded-lg p-4 shadow"
                                    data-aos="fade-up" data-aos-duration="900" data-aos-delay="100">
                                    <h1 class="font-semibold text-lg text-indigo-700 dark:text-indigo-300">Transaksi
                                    </h1>
                                    <h2 id="transactionCount"
                                        class="font-bold text-2xl mt-2 text-gray-800 dark:text-white">
                                        {{ $transactionCount }}</h2>
                                </div>
                                <div class="flex flex-col items-center bg-white dark:bg-gray-900 rounded-lg p-4 shadow"
                                    data-aos="fade-up" data-aos-duration="900" data-aos-delay="200">
                                    <h1 class="font-semibold text-lg text-indigo-700 dark:text-indigo-300">Best Seller
                                    </h1>
                                    <h2 id="bestSeller" class="font-bold text-2xl mt-2 text-gray-800 dark:text-white">
                                        {{ $bestSeller }}</h2>
                                </div>
                            </div>
                        </div>
                        {{-- Cards: Stok Terendah & Kadaluarsa (shadcn-like) --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-10" data-aos="fade-up" data-aos-duration="900">
                            {{-- Card: Stok Terendah --}}
                            <div class="rounded-xl border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-900 shadow-sm">
                                <div class="p-5 border-b border-gray-200 dark:border-gray-800 flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <div class="h-9 w-9 rounded-md bg-red-100 dark:bg-red-900/30 text-red-600 flex items-center justify-center">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M12 8v4m0 4h.01M21 12c0 4.97-4.03 9-9 9s-9-4.03-9-9 4.03-9 9-9 9 4.03 9 9z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <h3 class="text-base font-semibold leading-none tracking-tight">Obat Stok
                                                Terendah</h3>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">Prioritaskan restock
                                                segera</p>
                                        </div>
                                    </div>
                                    <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-semibold bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-200">
                                        Low stock
                                    </span>
                                </div>
                                <div class="p-5">
                                    <ul class="divide-y divide-gray-200 dark:divide-gray-800">
                                        @forelse ($lowStockMedicines as $medicine)
                                            <li class="py-3 flex items-center justify-between">
                                                <div class="min-w-0">
                                                    <p class="text-sm font-medium text-gray-900 dark:text-gray-100 truncate">
                                                        {{ $medicine->name }}
                                                    </p>
                                                    <div class="mt-1 flex items-center gap-2">
                                                        <span
                                                            class="inline-flex items-center rounded-full px-2 py-0.5 text-xs font-semibold bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-200">
                                                            Stok: {{ $medicine->stock }}
                                                        </span>
                                                        @if(!empty($medicine->sku))
                                                            <span class="text-xs text-gray-500 dark:text-gray-400">SKU:
                                                                {{ $medicine->sku }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <span class="h-2.5 w-2.5 rounded-full bg-red-500"></span>
                                            </li>
                                        @empty
                                            <li class="py-6 text-center text-sm text-gray-500 dark:text-gray-400">
                                                Semua stok aman
                                            </li>
                                        @endforelse
                                    </ul>
                                </div>
                                <div class="px-5 py-3 border-t border-gray-200 dark:border-gray-800 text-right">
                                    <a href="{{ route('medicines') }}"
                                        class="text-sm font-medium text-indigo-600 hover:text-indigo-700 dark:text-indigo-400 dark:hover:text-indigo-300">
                                        Lihat semua
                                    </a>
                                </div>
                            </div>

                            {{-- Card: Obat Kadaluarsa (<= 30 hari) --}}
                            <div class="rounded-xl border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-900 shadow-sm">
                                <div class="p-5 border-b border-gray-200 dark:border-gray-800 flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <div class="h-9 w-9 rounded-md bg-orange-100 dark:bg-orange-900/30 text-orange-600 flex items-center justify-center">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <h3 class="text-base font-semibold leading-none tracking-tight">Obat
                                                Kadaluarsa ≤ 30 Hari</h3>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">Cek tanggal exp dan
                                                lakukan retur</p>
                                        </div>
                                    </div>
                                    <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-semibold bg-orange-100 text-orange-700 dark:bg-orange-900/30 dark:text-orange-200">
                                        Expiring
                                    </span>
                                </div>
                                <div class="p-5">
                                    <ul class="divide-y divide-gray-200 dark:divide-gray-800">
                                        @forelse ($expiringMedicines as $medicine)
                                            <li class="py-3 flex items-center justify-between">
                                                <div class="min-w-0">
                                                    <p class="text-sm font-medium text-gray-900 dark:text-gray-100 truncate">
                                                        {{ $medicine->name }}
                                                    </p>
                                                    <div class="mt-1 flex items-center gap-2">
                                                        <span
                                                            class="inline-flex items-center rounded-full px-2 py-0.5 text-xs font-semibold bg-orange-100 text-orange-700 dark:bg-orange-900/30 dark:text-orange-200">
                                                            Exp: {{ $medicine->formatted_expiry_date }}
                                                        </span>
                                                        @if(!empty($medicine->batch))
                                                            <span class="text-xs text-gray-500 dark:text-gray-400">Batch:
                                                                {{ $medicine->batch }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <span class="h-2.5 w-2.5 rounded-full bg-orange-500"></span>
                                            </li>
                                        @empty
                                            <li class="py-6 text-center text-sm text-gray-500 dark:text-gray-400">
                                                Tidak ada obat mendekati kadaluarsa
                                            </li>
                                        @endforelse
                                    </ul>
                                </div>
                                <div class="px-5 py-3 border-t border-gray-200 dark:border-gray-800 text-right">
                                    <a href="{{ route('medicines') }}"
                                        class="text-sm font-medium text-indigo-600 hover:text-indigo-700 dark:text-indigo-400 dark:hover:text-indigo-300">
                                        Lihat semua
                                    </a>
                                </div>
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
