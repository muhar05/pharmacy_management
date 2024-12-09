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
                            Feature of Apotek Management
                        </h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-4">
                            <a href="{{ route('cashier') }}"
                                class="flex flex-col items-center justify-center p-4 rounded-lg bg-gray-800 hover:bg-gray-700 cursor-pointer">
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
                                class="flex flex-col items-center justify-center p-4 rounded-lg bg-gray-800 hover:bg-gray-700 cursor-pointer">
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
                        <div class="w-full bg-slate-800 mt-10 rounded-lg">
                            <div class="w-full flex p-5 justify-start items-center gap-6">
                                <form action="{{ route('dashboard') }}" method="GET" class="flex gap-2">
                                    <button name="period" value="daily"
                                        class="p-3 {{ $period === 'daily' ? 'bg-slate-900' : 'bg-slate-700' }} rounded-lg">Daily</button>
                                    <button name="period" value="weekly"
                                        class="p-3 {{ $period === 'weekly' ? 'bg-slate-900' : 'bg-slate-700' }} rounded-lg">Weekly</button>
                                    <button name="period" value="monthly"
                                        class="p-3 {{ $period === 'monthly' ? 'bg-slate-900' : 'bg-slate-700' }} rounded-lg">Monthly</button>
                                </form>
                            </div>
                            <div class="w-full p-6 grid grid-cols-2 gap-5 justify-center items-center text-center">
                                <div class="w-full flex flex-col justify-between col-span-2">
                                    <h1 class="font-semibold text-xl">Sum of Sales : </h1>
                                    <h2 class="font-semibold text-3xl">
                                        {{ $totalSales }}</h2>
                                </div>
                                <div class="w-full flex flex-col justify-between">
                                    <h1 class="font-semibold text-xl">Transaction : </h1>
                                    <h2 class="font-semibold text-3xl">{{ $transactionCount }}</h2>
                                </div>
                                <div class="w-full flex flex-col justify-between">
                                    <h1 class="font-semibold text-xl">Best Seller : </h1>
                                    <h2 class="font-semibold text-3xl">{{ $bestSeller }}</h2>
                                </div>
                            </div>
                        </div>
                        <div class="w-full mt-10 flex justify-center gap-5 items-star">
                            <div class="w-full p-4 bg-slate-800 rounded-lg flex-1">
                                <h1 class="font-semibold text-lg">Stok Rendah</h1>
                                <ul class="grid grid-cols-3 gap-4 p-2 list-disc">
                                    @foreach ($lowStockMedicines as $medicine)
                                        <li>{{ $medicine->name }} (Stock: {{ $medicine->stock }})</li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="w-full p-4 bg-slate-800 rounded-lg flex-1">
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
                e.preventDefault(); // Mencegah form dari submit biasa

                var period = $(this).val(); // Ambil nilai periode yang dipilih

                // Hapus kelas aktif dari semua tombol
                $('button[name="period"]').removeClass('bg-slate-900').addClass('bg-slate-700');

                // Tambahkan kelas aktif pada tombol yang diklik
                $(this).removeClass('bg-slate-700').addClass('bg-slate-900');

                $.ajax({
                    url: '{{ route('dashboard') }}',
                    method: 'GET',
                    data: {
                        period: period
                    },
                    success: function(data) {
                        // Update konten dengan data yang diterima
                        $('#totalSales').text(data.totalSales);
                        $('#transactionCount').text(data.transactionCount);
                        $('#bestSeller').text(data.bestSeller);
                    },
                    error: function(xhr) {
                        console.error(xhr);
                    }
                });
            });
        });
    </script>
</x-app-layout>
