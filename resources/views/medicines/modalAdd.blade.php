        <x-modal name="add-medicine-modal" class="w-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700" x-data="{
                categories: [
                    'Obat Keras',
                    'Obat Bebas Terbatas',
                    'Obat Bebas',
                ],
                valueCategory: [
                    3, // Obat Keras
                    2, // Obat Bebas Terbatas
                    1, // Obat Bebas
                ],
                types: [
                    'Suntikan',
                    'Infus',
                    'Injeksi',
                    'Obat Tetes',
                    'Sirup',
                    'Salep',
                    'Krim',
                    'Gel',
                    'Tablet',
                    'Kapsul',
                    'Serbuk',
                    'Suppositoria'
                ],
                units: [
                    'Tablet',
                    'Botol',
                    'Tube',
                    'Strip',
                    'Kapsul',
                    'Box',
                    'Ampul'
                ]
            }">
                <div
                    class ="flex items-center
                justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Add Medicine
                    </h3>
                    <button type="button" x-on:click="$dispatch('close')"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div>
                    <form class="p-4 md:p-5" action="{{ route('medicine.add') }}" method="POST">
                        @csrf
                        <div class="grid gap-4 mb-4 grid-cols-2">
                            <div class="col-span-2">
                                <label for="name"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Medicine
                                    Name</label>
                                <input type="text" name="name" id="name"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="Type product name" required="true">
                            </div>
                            <div class="col-span-2">
                                <label for="supplier_name"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Supplier
                                    Name</label>
                                <input type="text" name="supplier_name" id="supplier_name"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="Enter supplier name" required="true">
                            </div>
                            <div x-data="{
                                price: '',
                                formattedPrice: '',
                                updatePrice(event) {
                                    let value = event.target.value.replace(/[^,\d]/g, '').replace(/,/g, '.');
                                    this.formattedPrice = value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
                                    this.price = value.replace(/\./g, ''); // Hapus titik sebelum dikirim
                                }
                            }">
                                <label for="price"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Price</label>
                                <input type="text" id="price" @input="updatePrice($event)"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="Rp 50.000" required>
                                <input type="hidden" name="price" :value="price">
                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <label for="minimum_stock"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Minimum
                                    Stock</label>
                                <input type="text" name="minimum_stock" id="minimum_stock"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="10" required="true">
                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <label for="stock"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Stock</label>
                                <input type="text" name="stock" id="stock"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="10" required="true">
                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <label for="category_id"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
                                <select id="category_id" name="category_id" required
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                    <option value="" selected>Select category</option>
                                    <template x-for="(cat, index) in categories" :key="cat">
                                        <option :value="valueCategory[index]" x-text="cat"></option>
                                    </template>
                                </select>
                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <label for="type"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Type</label>
                                <select id="type" name="type" required
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                    <option value="" selected>Select Type</option>
                                    <template x-for="cat in types" :key="cat">
                                        <option :value="cat" x-text="cat"></option>
                                    </template>
                                </select>
                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <label for="unit"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Unit</label>
                                <select id="unit" name="unit" required
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                    <option value="" selected>Select Unit</option>
                                    <template x-for="cat in units" :key="cat">
                                        <option :value="cat" x-text="cat"></option>
                                    </template>
                                </select>
                            </div>
                            <div class="col-span-2">
                                <label for="dosage"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Dosage</label>
                                <input type="text" name="dosage" id="dosage" required
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="3x per day" required="true">
                            </div>
                            <div class="col-span-2">
                                <label for="instructions"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Instruction</label>
                                <input type="text" name="instructions" id="instructions" required
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="After meal" required="true">
                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <label for="date"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Expired
                                    Date</label>
                                <input type="date" name="expiry_date" id="expiry_date" required
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    required="true">
                            </div>
                            <div class="col-span-2">
                                <label for="description"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product
                                    Description</label>
                                <textarea id="description" rows="4" name="description" x-ref="description" required
                                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Write product description here"></textarea>
                            </div>
                        </div>
                        <button type="submit"
                            class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Save
                        </button>
                    </form>
                </div>
            </div>
        </x-modal>

        <script>
            function submitForm(event) {
                event.preventDefault();

                const formData = new FormData(event.target);

                const name = formData.get('name');
                const supplier_name = formData.get('supplier_name');
                const category_id = formData.get('category_id'); // Correct field name
                const unit = formData.get('unit');
                const price = formData.get('price');
                const minimum_stock = formData.get('minimum_stock');
                const stock = formData.get('stock');
                const type = formData.get('type');
                const dosage = formData.get('dosage');
                const instructions = formData.get('instructions');
                const expiry_date = formData.get('expiry_date');
                const description = formData.get('description');

                console.log(name, supplier_name, category_id, unit, price, minimum_stock, stock, type, dosage, instructions,
                    expiry_date, description);
            }
        </script>
