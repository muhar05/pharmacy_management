<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $title }}
        </h2>
    </x-slot>

    <main class="mt-10 w-full h-full">
        <div class="max-w-3xl mx-auto pb-10 px-4 sm:px-6 lg:px-8">
            <div id="medicine-detail-card" class="bg-white dark:bg-gray-800 shadow-lg rounded-xl p-8 opacity-0 translate-y-4 transition-all duration-700">
                <!-- Header: Name + Type + Status -->
                <div class="flex flex-col gap-3 mb-6">
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white">{{ $medicine->name }}</h1>
                    <div class="flex flex-wrap items-center gap-2">
                        <span class="inline-flex items-center px-3 py-1 rounded-full bg-blue-100 dark:bg-blue-900 text-blue-700 dark:text-blue-200 text-sm font-medium">
                            {{ $medicine->type }}
                        </span>

                        @php
                            $isExpired = \Carbon\Carbon::parse($medicine->expiry_date)->isPast();
                            $lowStock = $medicine->stock <= 10;
                        @endphp

                        @if($isExpired)
                            <span class="inline-flex items-center px-3 py-1 rounded-full bg-red-100 dark:bg-red-900 text-red-700 dark:text-red-200 text-sm font-medium">
                                Expired
                            </span>
                        @else
                            <span class="inline-flex items-center px-3 py-1 rounded-full bg-yellow-100 dark:bg-yellow-900 text-yellow-700 dark:text-yellow-200 text-sm font-medium">
                                Expiry: {{ $medicine->formatted_expiry_date }}
                            </span>
                        @endif

                        @if($lowStock)
                            <span class="inline-flex items-center px-3 py-1 rounded-full bg-orange-100 dark:bg-orange-900 text-orange-700 dark:text-orange-200 text-sm font-medium">
                                Low Stock
                            </span>
                        @endif
                    </div>
                </div>

                <!-- Description -->
                <div class="mb-8">
                    <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-2">Keterangan</h2>
                    <p class="text-gray-800 dark:text-gray-200">
                        {{ $medicine->description ?? 'Tidak ada keterangan' }}
                    </p>
                </div>

                <!-- Info Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-8">
                    <div class="bg-gray-50 dark:bg-gray-900 rounded-lg p-4">
                        <span class="block text-sm text-gray-500 dark:text-gray-400">Expired Date</span>
                        <span class="block mt-1 text-lg font-semibold text-gray-900 dark:text-white">
                            {{ $medicine->formatted_expiry_date }}
                        </span>
                    </div>

                    <div class="bg-gray-50 dark:bg-gray-900 rounded-lg p-4">
                        <span class="block text-sm text-gray-500 dark:text-gray-400">Stock</span>
                        <span class="block mt-1 text-lg font-semibold text-gray-900 dark:text-white">
                            {{ $medicine->stock }}
                        </span>
                    </div>

                    <div class="bg-gray-50 dark:bg-gray-900 rounded-lg p-4">
                        <span class="block text-sm text-gray-500 dark:text-gray-400">Supplier</span>
                        <span class="block mt-1 text-lg font-semibold text-gray-900 dark:text-white">
                            {{ $medicine->supplier->name }}
                        </span>
                    </div>

                    <div class="bg-gray-50 dark:bg-gray-900 rounded-lg p-4">
                        <span class="block text-sm text-gray-500 dark:text-gray-400">Created</span>
                        <span class="block mt-1 text-lg font-semibold text-gray-900 dark:text-white">
                            {{ $medicine->created_at->diffForHumans() }}
                        </span>
                    </div>

                    <div class="bg-gray-50 dark:bg-gray-900 rounded-lg p-4">
                        <span class="block text-sm text-gray-500 dark:text-gray-400">Updated</span>
                        <span class="block mt-1 text-lg font-semibold text-gray-900 dark:text-white">
                            {{ $medicine->updated_at->diffForHumans() }}
                        </span>
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex justify-between items-center">
                    <div class="flex items-center gap-2">
                        <a href="{{ route('medicines') }}" class="inline-block px-4 py-2 rounded-md bg-gray-100 dark:bg-gray-700 text-sm font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-200 dark:hover:bg-gray-600 transition">
                            &laquo; Back
                        </a>
                        @if (Route::has('medicines.edit'))
                            <a href="{{ route('medicines.edit', $medicine->id) }}" class="inline-block px-4 py-2 rounded-md bg-blue-600 text-white text-sm font-semibold hover:bg-blue-700 transition">
                                Edit
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const card = document.getElementById('medicine-detail-card');
            if (card) {
                setTimeout(() => {
                    card.classList.remove('opacity-0', 'translate-y-4');
                    card.classList.add('opacity-100', 'translate-y-0');
                }, 100); // delay for visible animation
            }
        });
    </script>
</x-app-layout>
