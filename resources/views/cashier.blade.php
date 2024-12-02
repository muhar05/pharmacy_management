<x-app-layout>
    <section class="bg-white py-8 antialiased dark:bg-gray-900 md:py-16">
        <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
            <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">Katalog Medicines</h2>

            <div class="mt-6 sm:mt-8 md:gap-6 lg:flex lg:items-start xl:gap-8">
                <div class="mx-auto w-full flex-none lg:max-w-2xl xl:max-w-3xl">
                    <input type="text" id="simple-search" autocomplete="off"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-4 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 mb-6"
                        placeholder="Search" required="">
                    <div class="space-y-6">
                        @foreach ($medicines as $medicine)
                            <div class="medicine-item rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800 md:p-6"
                                data-id="{{ $medicine->id }}" data-price="{{ $medicine->price }}"
                                data-category="{{ $medicine->category->name }}" data-name="{{ $medicine->name }}"
                                data-stock="{{ $medicine->stock }}">
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
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="mx-auto mt-6 max-w-4xl flex-1 space-y-6 lg:mt-0 lg:w-full">
                    <div
                        class="space-y-4 rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800 sm:p-6">
                        <p class="text-xl font-semibold text-gray-900 dark:text-white">Order summary</p>

                        <div class="space-y-4" id="order-summary">
                            <div class="space-y-2">
                                <dl class="flex items-center justify-between gap-4">
                                    <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Total Quantity
                                    </dt>
                                    <dd class="text-base font-medium text-green-600">
                                        <span class="total-quantity"></span>
                                    </dd>
                                </dl>
                                <dl
                                    class="flex items-center justify-between gap-4 border-t border-gray-200 pt-2 dark:border-gray-700">
                                    <dt class="text-base font-bold text-gray-900 dark:text-white">Total</dt>
                                    <dd class="text-base font-bold text-gray-900 dark:text-white"> <span
                                            class="total-price"></span></dd>
                                </dl>
                            </div>

                        </div>

                        <a href="#"
                            class="flex w-full items-center justify-center rounded-lg bg-primary-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 bg-green-600 hover:bg-green-800 focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Proceed
                            to Checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        // Define the formatRupiah function outside of updateOrderSummary
        function formatRupiah(totalPrice) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
            }).format(totalPrice);
        }

        function updateOrderSummary(medicineId) {
            const item = document.querySelector(`.medicine-item[data-id="${medicineId}"]`);
            const name = item.dataset.name;
            const category = item.dataset.category;
            const price = parseFloat(item.dataset.price);
            const quantity = parseInt(item.dataset.quantity);

            const orderSummary = document.querySelector('#order-summary');
            let existingItem = orderSummary.querySelector(`.summary-item[data-name="${name}"]`);

            if (existingItem) {
                // Update quantity and total price for existing item
                if (quantity > 0) {
                    existingItem.querySelector('.summary-quantity').textContent = quantity;
                    existingItem.querySelector('.summary-price').textContent = formatRupiah(price * quantity);
                } else {
                    existingItem.remove(); // Hapus item jika kuantitas 0
                }
            } else if (quantity > 0) {
                // Create new summary item if not exists and quantity > 0
                const newSummaryItem = document.createElement('div');
                newSummaryItem.className = 'summary-item space-y-2';
                newSummaryItem.setAttribute('data-name', name);
                newSummaryItem.innerHTML = `
            <dl class="flex items-center justify-between gap-4">
                <dt class="text-base font-normal text-gray-500 dark:text-gray-400">${name} (${category})</dt>
                <dd class="text-base font-medium text-green-600">
                    <span class="summary-quantity">${quantity}</span> pcs
                </dd>
                <dd class="text-base font-bold text-gray-900 dark:text-white summary-price" data-price="${price}">
                    ${formatRupiah(price * quantity)}
                </dd>
            </dl>
        `;
                orderSummary.appendChild(newSummaryItem);
            }

            // Update total quantity and total price
            let totalQuantity = 0;
            let totalPrice = 0;

            orderSummary.querySelectorAll('.summary-item').forEach(summaryItem => {
                const itemQuantity = parseInt(summaryItem.querySelector('.summary-quantity').textContent);
                const itemPrice = parseFloat(summaryItem.querySelector('.summary-price').dataset.price);

                totalQuantity += itemQuantity;
                totalPrice += itemPrice * itemQuantity;
            });

            document.querySelector('#order-summary .total-quantity').textContent = totalQuantity;
            document.querySelector('#order-summary .total-price').textContent = formatRupiah(totalPrice);
        }

        document.querySelectorAll('.increment-button').forEach(button => {
            button.addEventListener('click', () => {
                const medicineId = button.dataset.id;
                const item = document.querySelector(`.medicine-item[data-id="${medicineId}"]`);
                const input = document.querySelector(`#counter-input-${medicineId}`);
                const stockDisplay = item.querySelector('.stock-quantity');

                let stock = parseInt(item.dataset.stock);
                let currentQuantity = parseInt(input.value);

                console.log(`BEFORE Increment: 
            Medicine ID: ${medicineId}, 
            Current Stock: ${stock}, 
            Current Quantity: ${currentQuantity}`);

                // Hanya increment jika masih ada stok lebih dari 0
                if (stock > 0) {
                    currentQuantity += 1;
                    stock -= 1;

                    input.value = currentQuantity;
                    item.dataset.stock = stock;
                    item.dataset.quantity = currentQuantity;
                    stockDisplay.textContent = stock;

                    console.log(`AFTER Increment: 
                Medicine ID: ${medicineId}, 
                New Stock: ${stock}, 
                New Quantity: ${currentQuantity}`);

                    // Alert muncul HANYA ketika stock sudah 0
                    if (stock === 0) {
                        alert('Stok sudah habis');
                    }

                    updateOrderSummary(medicineId);
                } else {
                    console.log('Stok tidak mencukupi');
                    alert('Stok tidak mencukupi');
                }
            });
        });

        document.querySelectorAll('.decrement-button').forEach(button => {
            button.addEventListener('click', () => {
                const medicineId = button.dataset.id;
                const item = document.querySelector(`.medicine-item[data-id="${medicineId}"]`);
                const input = document.querySelector(`#counter-input-${medicineId}`);
                const stockDisplay = item.querySelector('.stock-quantity');

                let stock = parseInt(item.dataset.stock);
                let currentQuantity = parseInt(input.value);
                const maxStock = parseInt(item.dataset.maxStock || stock);

                console.log(`BEFORE Decrement: 
            Medicine ID: ${medicineId}, 
            Current Stock: ${stock}, 
            Current Quantity: ${currentQuantity}, 
            Max Stock: ${maxStock}`);

                // Decrement hanya jika kuantitas > 0
                if (currentQuantity > 0) {
                    currentQuantity -= 1;
                    stock += 1;

                    // Update input dan tampilan stok
                    input.value = currentQuantity;
                    item.dataset.stock = stock;
                    item.dataset.quantity = currentQuantity;
                    stockDisplay.textContent = stock;

                    console.log(`AFTER Decrement: 
                Medicine ID: ${medicineId}, 
                New Stock: ${stock}, 
                New Quantity: ${currentQuantity}`);

                    // Update ringkasan pesanan
                    updateOrderSummary(medicineId);
                } else {
                    console.log('Tidak bisa decrement lebih lanjut');
                }
            });
        });
    </script>
</x-app-layout>
