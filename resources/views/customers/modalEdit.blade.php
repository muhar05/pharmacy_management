<x-modal name="edit-customer-modal">
    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700" 
        x-data="{
            id: null,
            customer_name: '',
            phone: '',
            address: '',
            disease: ''
        }"
        x-on:set-customer-data.window="
            id = $event.detail.id;
            customer_name = $event.detail.customer_name;
            phone = $event.detail.phone;
            address = $event.detail.address;
            disease = $event.detail.disease ?? '';
        "
    >
        <!-- Modal header -->
        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                Edit Customer Name
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
        <form class="p-4 md:p-5" :action="`{{ route('customer.update', '') }}/${id}`" method="POST">
            @csrf
            @method('PUT')
            <div class="flex flex-col gap-2 mb-4">
                <div class="col-span-2">
                    <label for="customer_name"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Customer
                        Name</label>
                    <input type="text" name="customer_name" id="customer_name" x-model="customer_name"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="Adittya" required="true">
                </div>
                <div class="col-span-2">
                    <label for="phone"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Phone</label>
                    <input type="tel" name="phone" id="phone" x-model="phone"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="088348xxxxx" required>
                </div>
                <div class="col-span-2">
                    <label for="address"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Address</label>
                    <input type="text" name="address" id="address" x-model="address"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="Jl. Abu Bahar" required>
                </div>
                <div class="col-span-2">
                    <label for="disease"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Disease</label>
                    <input type="text" name="disease" id="disease" x-model="disease"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="Contoh: Diabetes, Hipertensi, dll">
                </div>
                <div class="mt-2">
                    <button type="submit"
                        class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 w-full justify-center">
                        Update
                    </button>
                </div>
            </div>
        </form>
    </div>
</x-modal>
