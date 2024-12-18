<x-app-layout>

    <body>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Medicines') }}
            </h2>
        </x-slot>

        <main class="mt-10 w-full h-full">
            <div class="max-w-7xl mx-auto sm:px-4 lg:px-8">
                <div>
                    <h1 class="text-balance p-4 text-5xl font-semibold tracking-tight dark:text-gray-200 sm:text-3xl">Table of
                        Medicines</h1>
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
                            <div class="overflow-x-auto mb-6">
                                <table class="w-full h-full text-sm text-left text-gray-500 dark:text-gray-400">
                                    <thead
                                        class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                        <tr>
                                            <th scope="col" class="px-4 py-3">Medicine name</th>
                                            <th scope="col" class="px-4 py-3">Category</th>
                                            <th scope="col" class="px-4 py-3">Stocks</th>
                                            <th scope="col" class="px-4 py-3">Price</th>
                                            <th scope="col" class="px-4 py-3">Supplier Name</th>
                                            <th scope="col" class="px-4 py-3">Type</th>
                                            <th scope="col" class="px-4 py-3">Expired At</th>
                                            <th scope="col" class="px-4 py-3">Actions
                                                <span class="sr-only">Actions</span>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($medicines->isEmpty())
                                            <tr>
                                                <td colspan="8"
                                                    class="px-4 py-3 text-center text-gray-500 dark:text-gray-400">
                                                    Tidak ada data obat.
                                                </td>
                                            </tr>
                                        @else
                                            @foreach ($medicines as $medicine)
                                                <tr class="border-b dark:border-gray-700">
                                                    <th scope="row"
                                                        class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white hover:underline">
                                                        <a href="{{ route('medicine.detail', $medicine->id) }}">
                                                            {{ $medicine->name }}</a>
                                                    </th>
                                                    <td class="px-4 py-3">{{ $medicine->category->name }}</td>
                                                    <td class="px-4 py-3">{{ $medicine->stock }}</td>
                                                    <td class="px-4 py-3">{{ formatRupiah($medicine->price) }}</td>
                                                    <td class="px-4 py-3">{{ $medicine->supplier->name }}</td>
                                                    <td class="px-4 py-3">{{ $medicine->type }}</td>
                                                    <td class="px-4 py-3">{{ $medicine->formatted_expiry_date }}</td>
                                                    <td class="px-4 py-3 flex items-center justify-center">
                                                        <div class="flex justify-center items-center w-44 shadow">
                                                            <div class="py-1">
                                                                <button x-data
                                                                    x-on:click.prevent="
                                                                            $dispatch('open-modal', 'edit-medicine-modal');
                                                                            $dispatch('set-medicine-data', {
                                                                                id: {{ $medicine->id }},
                                                                                name: '{{ $medicine->name }}',
                                                                                supplier_name: '{{ $medicine->supplier->name }}',
                                                                                minimum_stock: {{ $medicine->minimum_stock }},
                                                                                category: '{{ $medicine->category->name }}',
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
                                                                    class="w-full text-left block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                                                                    type="button">
                                                                    Edit
                                                                </button>
                                                            </div>
                                                            <div class="py-1">
                                                                <button x-data=""
                                                                    x-on:click.prevent="$dispatch('open-modal', 'delete-medicine-modal');
                                                                    $dispatch('set-medicine-data', {
                                                                        id: {{ $medicine->id }},
                                                                    })"
                                                                    class="w-full text-left block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                                                                    type="button">
                                                                    Delete
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        @include('medicines.modalEdit')

        @include('medicines.modalAdd')

        @include('medicines.modalDelete')

    </body>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        jQuery(function($) {
            let defaultTableContent = $('table tbody').html();

            $('#simple-search').on('keyup', function() {
                performSearch();
            });

            $('#filterDropdown input[type="checkbox"]').on('change', function() {
                performSearch();
            });

            function performSearch() {
                let query = $('#simple-search').val();

                // Ambil kategori yang dicentang
                let selectedCategories = [];

                $('#filterDropdown input[type="checkbox"]:checked').each(function() {
                    selectedCategories.push($(this).val());
                });

                // Jika input pencarian kosong dan tidak ada kategori yang dipilih, kembalikan ke data default
                if (!query.trim() && selectedCategories.length === 0) {
                    $('table tbody').html(defaultTableContent);
                    if (typeof initFlowbite === 'function') {
                        initFlowbite();
                    }
                    return;
                }

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: '/medicines/search',
                    method: 'POST',
                    data: {
                        query: query,
                        categories: selectedCategories // Kirim kategori yang dipilih ke server
                    },
                    success: function(response) {
                        console.log(response);
                        var tbody = $('table tbody');
                        tbody.empty();

                        if (response.length === 0) {
                            tbody.append(`
            <tr class="h-screen" rowspan="5">
                <td colspan="8" class="px-4 py-3 text-center text-gray-500 dark:text-gray-400">
                    Tidak ada data obat yang ditemukan.
                </td>
            </tr>
        `);
                        } else {
                            response.forEach(function(medicine) {
                                const expiryDate = medicine.formatted_expiry_date || '-';
                                tbody.append(`
                    <tr class="border-b dark:border-gray-700">
                        <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white hover:underline">
                            <a href="{{ route('medicine.detail', '') }}/${medicine.id}">
                                ${escapeHtml(medicine.name)}</a>
                        </th>
                        <td class="px-4 py-3">${escapeHtml(medicine.category)}</td>
                        <td class="px-4 py-3">${medicine.stock}</td>
                        <td class="px-4 py-3">${formatRupiah(medicine.price)}</td>
                        <td class="px-4 py-3">${escapeHtml(medicine.supplier_name)}</td>
                        <td class="px-4 py-3">${escapeHtml(medicine.type)}</td>
                        <td class="px-4 py-3">${expiryDate}</td>
                        <td class="px-4 py-3 flex items-center justify-center">
                            <div class="flex justify-center items-center w-44 shadow">
                                <div class="py-1">
                                    <button x-data
                                        x-on:click.prevent="
                                            $dispatch('open-modal', 'edit-medicine-modal');
                                            $dispatch('set-medicine-data', {
                                                id: '${medicine.id}',
                                                name: '${escapeHtml(medicine.name)}',
                                                supplier_name: '${escapeHtml(medicine.supplier_name)}',
                                                category: '${escapeHtml(medicine.category)}',
                                                price: ${medicine.price},
                                                stock: ${medicine.stock},
                                                type: '${escapeHtml(medicine.type)}',
                                                expiry_date: '${medicine.expiry_date || ''}',
                                                description: '${escapeHtml(medicine.description || '')}'
                                            })
                                        "
                                        class="w-full text-left block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                                        type="button">
                                        Edit
                                    </button>
                                </div>
                                <div class="py-1">
                                    <button x-data=""
                                        x-on:click.prevent="$dispatch('open-modal', 'delete-medicine-modal');
                                        $dispatch('set-medicine-data', {
                                            id: '${medicine.id}',
                                        })"
                                        class="w-full text-left block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                                        type="button">
                                        Delete
                                    </button>
                                </div>
                            </div>
                        </td>
                    </tr>
                `);
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                        var tbody = $('table tbody');
                        tbody.empty();
                        tbody.append(`
                        <tr>
                            <td colspan="8" class="px-4 py-3 text-center text-gray-500 dark:text-gray-400">
                                Terjadi kesalahan saat mencari data.
                            </td>
                        </tr>
                    `);
                    }
                });
            }

            function formatRupiah(amount) {
                return new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 0
                }).format(amount);
            }

            function escapeHtml(unsafe) {
                if (unsafe == null) return '';
                return unsafe
                    .replace(/&/g, "&amp;")
                    .replace(/</g, "&lt;")
                    .replace(/>/g, "&gt;")
                    .replace(/"/g, "&quot;")
                    .replace(/'/g, "&#039;");
            }
        });
    </script>



</x-app-layout>
