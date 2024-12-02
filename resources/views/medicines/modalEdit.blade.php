 <x-modal name="edit-medicine-modal" class="w-full">
     <div class="relative bg-white rounded-lg shadow dark:bg-gray-700" x-data="{
         id: null,
         name: '',
         supplier_name: '',
         category: '',
         category_id: '',
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
         price: '',
         stock: '',
         minimum_stock: '',
         unit: '',
         units: [
             'Tablet',
             'Botol',
             'Tube',
             'Strip',
             'Kapsul',
             'Box',
             'Ampul'
         ],
         type: '',
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
         expiry_date: '',
         description: '',
         dosage: '',
         instructions: '',
         updatePrice(event) {
             let value = event.target.value.replace(/[^,\d]/g, '').replace(/,/g, '.');
             this.formattedPrice = value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
             this.price = value ? value.replace(/\./g, '') : '0'; // Gunakan '0' jika kosong
         },
         init() {
             this.formattedPrice = (this.price || '0').toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
         }
     }"
         x-on:set-medicine-data.window="
                id = $event.detail.id;
                name = $event.detail.name;
                supplier_name = $event.detail.supplier_name;
                category_id = $event.detail.category_id;
                category = category_id;
                minimum_stock = $event.detail.minimum_stock;    
                unit = $event.detail.unit;
                price = ($event.detail.price || 0).toString();
                formattedPrice = price.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
                stock = $event.detail.stock;
                type = $event.detail.type;
                dosage = $event.detail.dosage;
                instructions = $event.detail.instructions;
                expiry_date = $event.detail.expiry_date.split(' ')[0];
                description = $event.detail.description;
    ">
         <!-- Modal header -->
         <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
             <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                 Edit Medicine
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
         <form class="p-4 md:p-5" :action="`{{ route('medicine.update', '') }}/${id}`" method="POST">
             @csrf
             @method('PUT')
             <div class="grid gap-4 mb-4 grid-cols-2">
                 <div class="col-span-2">
                     <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Medicine
                         Name</label>
                     <input type="text" name="name" id="name" x-model="name"
                         class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                         placeholder="Type product name" required="">
                 </div>
                 <div class="col-span-2">
                     <label for="supplier_name"
                         class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Supplier
                         Name</label>
                     <input type="text" name="supplier_name" id="supplier_name" x-model="supplier_name"
                         class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                         placeholder="Type product name" required="">
                 </div>
                 <div class="col-span-2 sm:col-span-1">
                     <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                         Price
                     </label>
                     <input type="text" id="price" x-model="formattedPrice" @input="updatePrice($event)"
                         class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                         :placeholder="'Rp ' + (formattedPrice || '0')" required>
                     <input type="hidden" name="price" x-model="price">
                 </div>
                 <div class="col-span-2 sm:col-span-1">
                     <label for="minimum_stock"
                         class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Minimum Stock</label>
                     <input type="number" name="minimum_stock" id="minimum_stock" x-model="minimum_stock"
                         class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                         placeholder="10" required>
                 </div>
                 <div class="col-span-2 sm:col-span-1">
                     <label for="price"
                         class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Stock</label>
                     <input type="number" name="stock" id="stock" x-model="stock"
                         class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                         placeholder="10" required>
                 </div>
                 <div class="col-span-2 sm:col-span-1">
                     <label for="category"
                         class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
                     <select id="category" name="category_id" x-model="category"
                         class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                         <option value="">Select category</option>
                         <template x-for="(cat, index) in categories" :key="cat">
                             <option :value="valueCategory[index]" x-text="cat"></option>
                         </template>
                     </select>
                 </div>
                 <div class="col-span-2 sm:col-span-1">
                     <label for="type"
                         class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Type</label>
                     <select id="type" name="type" x-model="type"
                         class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                         <option value="">Select Type</option>
                         <template x-for="cat in types" :key="cat">
                             <option :value="cat" x-text="cat"></option>
                         </template>
                     </select>
                 </div>
                 <div class="col-span-2 sm:col-span-1">
                     <label for="unit"
                         class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Unit</label>
                     <select id="unit" name="unit" x-model="unit"
                         class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                         <option value="">Select Unit</option>
                         <template x-for="cat in units" :key="cat">
                             <option :value="cat" x-text="cat"></option>
                         </template>
                     </select>
                 </div>
                 <div class="col-span-2">
                     <label for="dosage"
                         class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Dosage</label>
                     <input type="text" name="dosage" id="dosage" x-model="dosage" required
                         class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                         placeholder="3x per day" required="true">
                 </div>
                 <div class="col-span-2">
                     <label for="instructions"
                         class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Instructions</label>
                     <input type="text" name="instructions" id="instructions" required x-model="instructions"
                         class="bg-gray-5 0 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                         placeholder="3x per day" required="true">
                 </div>
                 <div class="col-span-2 sm:col-span-1">
                     <label for="expiry_date"
                         class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Expired
                         Date</label>
                     <input type="date" name="expiry_date" id="expiry_date" x-model="expiry_date"
                         class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                         required="">
                 </div>
                 <div class="col-span-2">
                     <label for="description"
                         class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product
                         Description</label>
                     <textarea id="description" name="description" rows="4" x-model="description"
                         class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                         placeholder="Write product description here"></textarea>
                 </div>
             </div>
             <button type="submit"
                 class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                 Update
             </button>
         </form>
     </div>
 </x-modal>
