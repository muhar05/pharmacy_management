<x-app-layout>
    @vite(['resources/css/app.css', 'resources/js/cashier.js'])
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <section class="bg-white py-8 antialiased dark:bg-gray-900 md:py-16">
        <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
            <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">Katalog Medicines</h2>

            <div class="mt-6 sm:mt-8 md:gap-6 lg:flex lg:items-start xl:gap-8">
                <div class="mx-auto w-full flex-none lg:max-w-2xl xl:max-w-3xl">
                    <input type="text" id="medicine-search" autocomplete="off"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-4 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 mb-6"
                        placeholder="Search" required="">
                    <div class="space-y-6" id="medicine-list">
                        @foreach ($medicines as $medicine)
                            <div class="medicine-item rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800 md:p-6"
                                data-id="{{ $medicine->id }}" data-price="{{ $medicine->price }}"
                                data-category="{{ $medicine->category->name }}" data-name="{{ $medicine->name }}"
                                data-stock="{{ $medicine->stock }}" data-initial-stock="{{ $medicine->stock }}">
                                <div class="space-y-4 md:flex md:items-center md:justify-between md:gap-6 md:space-y-0">
                                    <label for="counter-input-{{ $medicine->id }}" class="sr-only">Choose
                                        quantity:</label>
                                    <div class="flex items-center justify-between md:order-3 md:justify-end">
                                        <div class="flex items-center">
                                            <button type="button" class="decrement-button"
                                                data-id="{{ $medicine->id }}">
                                                <svg class="h-2.5 w-2.5 text-gray-900 dark:text-white"
                                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 18 2">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2" d="M1 1h16" />
                                                </svg>
                                            </button>
                                            <input type="text" id="counter-input-{{ $medicine->id }}"
                                                class="quantity-input w-10 shrink-0 border-0 bg-transparent text-center text-sm font-medium text-gray-900 focus:outline-none focus:ring-0 dark:text-white"
                                                value="0" required disabled />
                                            <button type="button" class="increment-button"
                                                data-id="{{ $medicine->id }}">
                                                <svg class="h-2.5 w-2.5 text-gray-900 dark:text-white"
                                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 18 18">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16" />
                                                </svg>
                                            </button>
                                        </div>
                                        <div class="text-end md:order-4 md:w-32">
                                            <p class="text-base font-bold text-gray-900 dark:text-white">
                                                {{ formatRupiah($medicine->price) }}</p>
                                        </div>
                                    </div>

                                    <div class="w-full min-w-0 flex-1 space-y-4 md:order-2 md:max-w-md">
                                        <a href="#"
                                            class="text-base font-medium text-gray-900 hover:underline dark:text-white">{{ $medicine->name }}
                                            || {{ $medicine->category->name }}</a>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">
                                            {{ $medicine->description }}
                                        </p>
                                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Type:
                                            {{ $medicine->type }}</p>
                                    </div>
                                </div>
                                <div class="flex justify-end">
                                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Stock available:
                                        <span class="stock-quantity">
                                            {{ $medicine->stock }}
                                        </span>
                                    </p>
                                </div>
                                @if ($medicine->stock === 0)
                                    <span class="badge bg-red-500 text-white rounded-full px-2 py-1 text-xs">Stok
                                        Kosong</span>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="mx-auto mt-6 max-w-4xl flex-1 space-y-6 lg:mt-0 lg:w-full">
                    <form id="checkout-form" action="{{ route('cashier.checkout') }}" method="POST">
                        @csrf
                        <div
                            class="space-y-4 rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800 sm:p-6">
                            <p class="text-xl font-semibold text-gray-900 dark:text-white">Order summary</p>

                            <div id="form-resep">
                            </div>
                            <div class="space-y-4">
                                <label for="customer"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Customer
                                    Name</label>
                                <input type="text" name="customer" id="customer"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="Lydia Muharrem" required readonly disabled>
                                <label for="phone"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Customer
                                    Phone</label>
                                <input type="number" name="customerPhone" id="customerPhone"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="+62812345xxxx" required readonly disabled>
                                <label for="address"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Customer
                                    Address</label>
                                <input type="text" name="customerAddress" id="customerAddress"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="Jl. Raya No. 123" required readonly disabled>
                            </div>

                            <div class="space-y-4" id="order-summary">
                                <div class="space-y-2">
                                    <dl class="flex items-center justify-between gap-4">
                                        <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Total
                                            Quantity</dt>
                                        <dd class="text-base font-medium text-green-600">
                                            <span class="total-quantity"></span>
                                        </dd>
                                    </dl>
                                    <div id="error-container" class="error-messages p-2 rounded-md"></div>
                                    <dl
                                        class="flex items-center justify-between gap-4 border-t border-gray-200 pt-2 dark:border-gray-700">
                                        <dt class="text-base font-bold text-gray-900 dark:text-white">Total</dt>
                                        <dd class="text-base font-bold text-gray-900 dark:text-white"> <span
                                                class="total-price"></span></dd>
                                    </dl>
                                </div>
                            </div>

                            <button type="submit" id="checkout-button"
                                class="flex w-full items-center justify-center rounded-lg bg-primary-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 bg-green-600 hover:bg-green-800 focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Proceed
                                to Checkout</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#medicine-search').on('keyup', function() {
                    let searchTerm = $(this).val().toLowerCase(); // Ambil nilai input pencarian
                    $('#medicine-list .medicine-item').each(function() {
                        let medicineName = $(this).data('name')
                            .toLowerCase(); // Ambil nama obat dari data atribut
                        // Tampilkan/hilangkan item berdasarkan pencarian
                        if (medicineName.includes(searchTerm)) {
                            $(this).show();
                        } else {
                            $(this).hide();
                        }
                    });
                });
            });
        </script>
    </section>
</x-app-layout>
