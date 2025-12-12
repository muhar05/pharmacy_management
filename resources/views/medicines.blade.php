<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Medicines') }}
        </h2>
    </x-slot>

    <main class="mt-10 w-full h-full">
        <div class="max-w-7xl mx-auto sm:px-4 lg:px-8">
            <div>
                <h1 class="p-4 text-3xl font-semibold tracking-tight dark:text-gray-200">Table of Medicines</h1>
                <div class="w-full p-4">
                    <div class="w-full flex justify-end mb-5 mt-5">
                        <button id="filterDropdownButton" data-dropdown-toggle="filterDropdown"
                            class="w-full md:w-auto flex items-center justify-center py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"
                            type="button">
                            <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
                                class="h-4 w-4 mr-2 text-gray-400" viewbox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z"
                                    clip-rule="evenodd" />
                            </svg>
                            Filter
                            <svg class="-mr-1 ml-1.5 w-5 h-5" fill="currentColor" viewbox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path clip-rule="evenodd" fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                            </svg>
                        </button>
                        <div id="filterDropdown"
                            class="z-50 fixed hidden w-48 p-3 bg-white rounded-lg shadow dark:bg-gray-700">
                            <h6 class="mb-3 text-sm font-medium text-gray-900 dark:text-white">
                                Choose category</h6>
                            <ul class="space-y-2 text-sm" aria-labelledby="filterDropdownButton">
                                <li class="flex items-center">
                                    <input id="obatKeras" type="checkbox" value="Obat Keras"
                                        class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                    <label for="obatKeras"
                                        class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">Obat
                                        Keras
                                    </label>
                                </li>
                                <li class="flex items-center">
                                    <input id="obatBebas" type="checkbox" value="Obat Bebas"
                                        class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                    <label for="obatBebas"
                                        class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">Obat
                                        Bebas
                                    </label>
                                </li>
                                <li class="flex items-center">
                                    <input id="obatBebasTerbatas" type="checkbox" value="Obat Bebas Terbatas"
                                        class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                    <label for="obatBebasTerbatas"
                                        class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">Obat
                                        Bebas Terbatas
                                    </label>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                        <div
                            class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                            <div class="w-full md:w-1/2">
                                <form class="flex items-center">
                                    <label for="simple-search" class="sr-only">Search</label>
                                    <div class="relative w-full">
                                        <div
                                            class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                            <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                                fill="currentColor" viewbox="0 0 20 20"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        <input type="text" id="simple-search"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            placeholder="Search" required="">
                                    </div>
                                </form>
                            </div>
                            <div
                                class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                                <button type="button" x-data=""
                                    x-on:click.prevent="$dispatch('open-modal', 'add-medicine-modal')"
                                    class="flex items-center justify-center dark:text-white dark:bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                                    <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                        <path clip-rule="evenodd" fill-rule="evenodd"
                                            d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                                    </svg>
                                    Add Medicine
                                </button>
                                <div class="flex items-center space-x-3 w-full md:w-auto">
                                    <button id="actionsDropdownButton" data-dropdown-toggle="actionsDropdown"
                                        class="w-full md:w-auto flex items-center justify-center py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"
                                        type="button">
                                        <svg class="-ml-1 mr-1.5 w-5 h-5" fill="currentColor" viewbox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                            <path clip-rule="evenodd" fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                                        </svg>
                                        Actions
                                    </button>
                                    <div id="actionsDropdown"
                                        class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                                        <ul class="py-1 text-sm text-gray-700 dark:text-gray-200"
                                            aria-labelledby="actionsDropdownButton">
                                            <li>
                                                <a href="{{ route('medicines.export') }}"
                                                    class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                                                    Export XLSX
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ route('medicines.export-pdf') }}"
                                                    class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                                                    Export PDF
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="medicines-table" class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden opacity-0 transition-opacity duration-500">
                            <div class="overflow-x-auto mb-6">
                                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                        <tr>
                                            <th class="px-4 py-3">Medicine name</th>
                                            <th class="px-4 py-3">Category</th>
                                            <th class="px-4 py-3">Stocks</th>
                                            <th class="px-4 py-3">Price</th>
                                            <th class="px-4 py-3">Supplier</th>
                                            <th class="px-4 py-3">Expired At</th>
                                            <th class="px-4 py-3 text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($medicines as $medicine)
                                            <tr class="border-b dark:border-gray-700">
                                                <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                    {{ $medicine->name }}
                                                </td>
                                                <td class="px-4 py-3">{{ $medicine->category->name ?? '-' }}</td>
                                                <td class="px-4 py-3">{{ $medicine->stock }}</td>
                                                <td class="px-4 py-3">{{ formatRupiah($medicine->price) }}</td>
                                                <td class="px-4 py-3">{{ $medicine->supplier->name ?? '-' }}</td>
                                                <td class="px-4 py-3">{{ $medicine->formatted_expiry_date }}</td>
                                                <td class="px-4 py-3 flex items-center justify-center gap-2">
                                                    <a href="{{ route('medicine.detail', $medicine->id) }}"
                                                       class="inline-flex items-center px-3 py-1.5 rounded-md bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-medium transition">
                                                        View Details
                                                    </a>
                                                    <button x-data
                                                        x-on:click.prevent="
                                                            $dispatch('open-modal', 'edit-medicine-modal');
                                                            $dispatch('set-medicine-data', {
                                                                id: {{ $medicine->id }},
                                                                name: '{{ $medicine->name }}',
                                                                supplier_name: '{{ $medicine->supplier->name ?? '' }}',
                                                                minimum_stock: {{ $medicine->minimum_stock }},
                                                                category: '{{ $medicine->category->name ?? '' }}',
                                                                category_id: {{ $medicine->category_id }},
                                                                unit: '{{ $medicine->unit }}',
                                                                price: {{ $medicine->price }},
                                                                stock: {{ $medicine->stock }},
                                                                dosage: '{{ $medicine->dosage }}',
                                                                instructions: '{{ $medicine->instructions }}',
                                                                type: '{{ $medicine->type }}',
                                                                expiry_date: '{{ $medicine->expiry_date }}',
                                                                description: '{{ $medicine->description }}'
                                                            })
                                                        "
                                                        class="inline-flex items-center px-3 py-1.5 rounded-md bg-yellow-500 hover:bg-yellow-600 text-white text-xs font-medium transition"
                                                        type="button">
                                                        Edit
                                                    </button>
                                                    <button x-data=""
                                                        x-on:click.prevent="$dispatch('open-modal', 'delete-medicine-modal');
                                                            $dispatch('set-medicine-data', {
                                                                id: {{ $medicine->id }},
                                                            })"
                                                        class="inline-flex items-center px-3 py-1.5 rounded-md bg-red-600 hover:bg-red-700 text-white text-xs font-medium transition"
                                                        type="button">
                                                        Delete
                                                    </button>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="px-4 py-3 text-center text-gray-500 dark:text-gray-400">
                                                    Tidak ada data obat.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            {{-- PAGINATION --}}
                            <div class="px-4 pb-4">
                                @if ($medicines instanceof \Illuminate\Pagination\LengthAwarePaginator || $medicines instanceof \Illuminate\Pagination\Paginator)
                                    {{ $medicines->onEachSide(1)->links() }}
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    @include('medicines.modalEdit')
    @include('medicines.modalAdd')
    @include('medicines.modalDelete')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const table = document.getElementById('medicines-table');
            if (table) {
                setTimeout(() => {
                    table.classList.remove('opacity-0');
                    table.classList.add('opacity-100');
                }, 100); // delay agar animasi terlihat
            }

            // Search AJAX
            const searchInput = document.getElementById('simple-search');
            if (searchInput) {
                searchInput.addEventListener('keyup', function() {
                    const query = this.value;
                    fetchSearch(query, getSelectedCategories());
                });
            }

            // Filter AJAX
            const filterCheckboxes = document.querySelectorAll('#filterDropdown input[type="checkbox"]');
            filterCheckboxes.forEach(cb => {
                cb.addEventListener('change', function() {
                    fetchSearch(searchInput.value, getSelectedCategories());
                });
            });

            function getSelectedCategories() {
                return Array.from(filterCheckboxes)
                    .filter(cb => cb.checked)
                    .map(cb => cb.value);
            }

            function fetchSearch(query, categories) {
                fetch("{{ route('medicine.search') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        "X-Requested-With": "XMLHttpRequest" // <-- tambahkan ini!
                    },
                    body: JSON.stringify({ query: query, categories: categories })
                })
                .then(res => res.json())
                .then(data => {
                    document.querySelector('#medicines-table').innerHTML = data.html;
                });
            }
        });
    </script>
</x-app-layout>
