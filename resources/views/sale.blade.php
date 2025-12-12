<x-app-layout>

    <body>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ $title }}
            </h2>
        </x-slot>

        <main class="mt-10 w-full h-full">
            <div class="max-w-7xl mx-auto px-6 lg:px-8">
                <!-- Sale Summary Card -->
                <div class="bg-gray-900 text-white overflow-hidden shadow-lg sm:rounded-lg p-8">
                    <!-- Header Section -->
                    <div class="mb-6 border-b border-gray-700 pb-4">
                        <h1 class="text-3xl font-bold">{{ $sale->formatted_sale_date }}</h1>
                        <p class="text-lg text-gray-400 font-medium">{{ $sale->payment_status }}</p>
                    </div>

                    <!-- Info Section -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
                        <div>
                            <h2 class="text-gray-400 text-sm uppercase">Served by</h2>
                            <p class="text-lg font-semibold">{{ $sale->user->name }}</p>
                        </div>
                        <div>
                            <h2 class="text-gray-400 text-sm uppercase">Paid by</h2>
                            <p class="text-lg font-semibold">{{ $sale->customer->name }}</p>
                        </div>
                    </div>

                    <!-- Details Section -->
                    <div class="mb-8">
                        <h2 class="text-2xl font-bold mb-4">Details</h2>
                        <h2 class="text-gray-400 text-sm mb-4">Doctor Name : {{ $sale->doctor_name ?? 'Obat tidak membutuhkan Resep Dokter' }}</h2>
                        <h2 class="text-gray-400 text-sm mb-4">Doctor Phone : {{ $sale->doctor_phone ?? 'Obat tidak membutuhkan Resep Dokter' }}</h2>
                        <div class="overflow-hidden rounded-lg shadow-md bg-gray-800">
                            <ul class="divide-y divide-gray-700">
                                @foreach ($sale->saleDetails as $detail)
                                    <li class="flex justify-between items-center py-4 px-6">
                                        <div>
                                            <h3 class="text-lg font-semibold">{{ $detail->medicine->name }}</h3>
                                            <p class="text-sm text-gray-400">Category:
                                                {{ $detail->medicine->category->name }}</p>
                                        </div>
                                        <div class="text-right">
                                            <p class="text-gray-400">Quantity: <span
                                                    class="font-semibold">{{ $detail->quantity }}</span></p>
                                            <p class="text-gray-400">Price: <span
                                                    class="font-semibold">{{ formatRupiah($detail->price) }}</span></p>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <!-- Total Amount Section -->
                    <div class="text-right mb-8">
                        <h2 class="text-gray-400 text-sm uppercase">Total Amount</h2>
                        <p class="text-3xl font-bold">{{ formatRupiah($sale->total_amount) }}</p>
                    </div>

                    <!-- Back Button -->
                    <div class="text-center">
                        <a href="{{ route('sales') }}"
                            class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-6 rounded-lg transition duration-300">
                            &laquo; Back to Sales
                        </a>
                    </div>
                </div>
            </div>
        </main>
    </body>
</x-app-layout>
