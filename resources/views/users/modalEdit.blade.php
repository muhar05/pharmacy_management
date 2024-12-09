<x-modal name="edit-user-modal">
    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700" x-data="{
        id: null,
        positions: [
            'admin',
            'cashier',
            'pharmacist',
            'inventory_manager'
        ],
        position: ''
    }"
        x-on:set-user-data.window="
            id = $event.detail.id;
            position = $event.detail.position;
        ">
        <!-- Modal header -->
        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                Edit Users
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
        <form class="p-4 md:p-5" :action="`{{ route('user.update', '') }}/${id}`" method="POST">
            @csrf
            @method('PATCH')
            <div class="flex flex-col gap-2 mb-4">
                <label for="position"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Position</label>
                <select id="position" name="position" x-model="position"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                    <option value="">Select position</option>
                    <template x-for="(position, index) in positions" :key="position">
                        <option :value="position" x-text="position"></option>
                    </template>
                </select>
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
