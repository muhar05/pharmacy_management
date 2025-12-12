<x-modal name="edit-sale-modal" class="w-full">
    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700" x-data="{
        id: null,
        customer_name: '',
        old_customer_name: '',
        payment_status: '',
        sale_date: '',
        showAdditionalFields: false,
    }"
        x-on:set-sale-data.window="
               id = $event.detail.id;
               customer_name = $event.detail.customer_name;
               old_customer_name = $event.detail.customer_name;
               payment_status = $event.detail.payment_status;          
               sale_date = $event.detail.sale_date;
               showAdditionalFields = false;
   "
        x-effect="showAdditionalFields = customer_name !== old_customer_name">
        <!-- Modal header -->
        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                Edit Sale
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
        <form class="p-4 md:p-5" :action="`{{ route('sale.update', '') }}/${id}`" method="POST">
            @csrf
            @method('PUT')
            <div class="grid gap-4 mb-4 grid-cols-2">
                <div class="col-span-2">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Customer
                        Name</label>
                    <input type="text" name="customer_name" id="customer_name" x-model="customer_name"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="Type customer name" required>
                </div>

                <!-- Conditional additional fields -->
                <template x-if="showAdditionalFields">
                    <div class="col-span-2 grid gap-4">
                        <div class="col-span-2">
                            <label for="customer_phone"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Phone</label>
                            <input type="number" name="customer_phone" id="customer_phone"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Enter phone number">
                        </div>
                        <div class="col-span-2">
                            <label for="customer_address"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Address</label>
                            <input type="text" name="customer_address" id="customer_address"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Enter address">
                        </div>
                    </div>
                </template>

                <div class="col-span-2">
                    <label for="payment_status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Payment Status
                    </label>
                    <div class="flex items-center gap-2">
                        <div class="relative w-10 h-6">
                            <input type="checkbox" id="payment_status_toggle"
                                x-on:change="payment_status = $el.checked ? 'Paid' : 'Unpaid'"
                                :checked="payment_status === 'Paid'" class="hidden">
                            <div @click="payment_status = (payment_status === 'Paid') ? 'Unpaid' : 'Paid'"
                                :class="payment_status === 'Paid' ? 'bg-green-500' : 'bg-gray-200'"
                                class="absolute w-full h-full rounded-full cursor-pointer transition-colors duration-300">
                                <span :class="payment_status === 'Paid' ? 'translate-x-4' : 'translate-x-0'"
                                    class="absolute top-1/2 left-1 w-4 h-4 bg-white rounded-full shadow transform -translate-y-1/2 transition-transform duration-300"></span>
                            </div>
                        </div>
                        <span x-text="payment_status === 'Paid' ? 'Paid' : 'Unpaid'"
                            class="text-sm font-medium text-gray-900 dark:text-gray-400"></span>
                    </div>
                    <!-- Hidden input to send payment_status -->
                    <input type="hidden" name="payment_status" :value="payment_status">
                </div>

                <div class="col-span-2 sm:col-span-1">
                    <label for="sale_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Sale
                        Date</label>
                    <input type="date" name="sale_date" id="sale_date" x-model="sale_date"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        required>
                </div>
            </div>
            <!-- Display error message -->
            <div x-show="errorMessage" class="text-red-500 text-sm mt-2">
                <p x-text="errorMessage"></p>
            </div>

            <button type="submit"
                class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Update
            </button>
        </form>
    </div>
</x-modal>
