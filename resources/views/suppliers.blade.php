<x-app-layout>

    <head>
        <title>Suppliers</title>
    </head>

    <body>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Suppliers') }}
            </h2>
        </x-slot>

        <main class="mt-10 w-full h-full">
            <div class="max-w-7xl mx-auto sm:px-4 lg:px-8">
                <div>
                    <h1 class="text-balance p-4 text-5xl font-semibold tracking-tight text-gray-200 sm:text-3xl">Table of
                        Suppliers</h1>
                    <div class="mt-6 w-full pb-6">
                        {{-- Tambahkan tombol Add Supplier --}}
                        <div class="mb-4 flex justify-between w-full">
                            <button x-data x-on:click.prevent="$dispatch('open-modal', 'add-supplier-modal')"
                                class="flex items-center justify-center py-2 px-4 text-sm font-medium text-white bg-primary-600 rounded-lg hover:bg-primary-700 focus:outline-none focus:ring-4 focus:ring-primary-200 dark:bg-primary-700 dark:hover:bg-primary-800 dark:focus:ring-primary-900">
                                + Add Supplier
                            </button>
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
                                        <a href="{{ route('suppliers.export-xlsx') }}"
                                            class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                                            Export XLSX
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('suppliers.export-pdf') }}"
                                            class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                                            Export PDF
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <input type="text" id="supplier-search" autocomplete="off"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-4 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 mb-6"
                            placeholder="Search" required="">
                        <div class="relative overflow-hidden bg-white shadow-md dark:bg-gray-800 sm:rounded-lg">
                            <div class="overflow-x-auto">
                                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                    <thead
                                        class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                        <tr>
                                            <th scope="col" class="px-4 py-3">Supplier Name</th>
                                            {{-- <th scope="col" class="px-4 py-3">Address</th> --}}
                                            <th scope="col" class="px-4 py-3">Phone</th>
                                            <th scope="col" class="px-4 py-3">Email</th>
                                            <th scope="col" class="px-4 py-3">Created At</th>
                                            <th scope="col" class="px-4 py-3">Last Update</th>
                                            <th scope="col" class="px-4 py-3">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="supplier-list">
                                        @if ($suppliers->isEmpty())
                                            <tr>
                                                <td colspan="6"
                                                    class="px-4 py-2 text-center text-gray-500 dark:text-gray-400">
                                                    Tidak ada data supplier.
                                                </td>
                                            </tr>
                                        @else
                                            @foreach ($suppliers as $supplier)
                                                <tr class="supplier-item border-b dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700"
                                                    data-supplier_name="{{ $supplier->name }}">
                                                    <th scope="row"
                                                        class="flex items-center px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                        {{ $supplier->name }}
                                                    </th>
                                                    {{-- <td
                                                        class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                        {{ !empty($supplier->address) ? $supplier->address : 'N/A' }}
                                                    </td> --}}
                                                    <td
                                                        class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                        <div class="flex items-center">
                                                            {{ !empty($supplier->phone) ? $supplier->phone : 'N/A' }}
                                                        </div>
                                                    </td>
                                                    <td
                                                        class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                        {{ !empty($supplier->email) ? $supplier->email : 'N/A' }}
                                                    </td>
                                                    <td class="px-4 py-2">
                                                        {{ $supplier->created_at }}
                                                    </td>
                                                    <td class="px-4 py-2">
                                                        {{ $supplier->updated_at }}
                                                    </td>
                                                    <td class="px-4 py-3 flex items-center justify-center">
                                                        <div class="flex justify-center items-center w-44 shadow">
                                                            <div class="py-1">
                                                                <button x-data
                                                                    x-on:click.prevent="
                                                                    $dispatch('open-modal', 'edit-supplier-modal');
                                                                    $dispatch('set-supplier-data', {
                                                                        id: {{ $supplier->id }},
                                                                        supplier_name: '{{ addslashes($supplier->name) }}',
                                                                        phone: '{{ $supplier->phone }}',
                                                                        email: '{{ addslashes($supplier->email) }}',
                                                                        address: `{{ addslashes($supplier->address) }}`
                                                                    })
                                                                "
                                                                    class="w-full text-left block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                                                                    type="button">
                                                                    Edit
                                                                </button>
                                                            </div>
                                                            <div class="py-1">
                                                                <button x-data=""
                                                                    x-on:click.prevent="$dispatch('open-modal', 'delete-supplier-modal');
                                                                    $dispatch('set-supplier-data', {
                                                                        id: {{ $supplier->id }},
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

        @include('suppliers.modalEdit')

        @include('suppliers.modalDelete')

        {{-- Modal Add Supplier --}}
        <x-modal name="add-supplier-modal" focusable>
            <form method="POST" action="{{ route('supplier.create') }}" class="p-6">
                @csrf
                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">Add New Supplier</h2>
                <div class="mb-4">
                    <label for="supplier_name"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Supplier Name</label>
                    <input type="text" name="supplier_name" id="supplier_name" required maxlength="255"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                </div>
                <div class="mb-4">
                    <label for="phone"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Phone (+62...)</label>
                    <input type="text" name="phone" id="phone" required pattern="^\+62[0-9]{9,13}$"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                </div>
                <div class="mb-4">
                    <label for="email"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                    <input type="email" name="email" id="email" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                </div>
                <div class="mb-4">
                    <label for="address"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Address</label>
                    <input type="text" name="address" id="address" required maxlength="255"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                </div>
                <div class="flex justify-end">
                    <button type="button" x-on:click="$dispatch('close')"
                        class="mr-2 px-4 py-2 bg-gray-300 rounded hover:bg-gray-400 dark:bg-gray-600 dark:hover:bg-gray-500">Cancel</button>
                    <button type="submit"
                        class="px-4 py-2 bg-primary-600 text-white rounded hover:bg-primary-700">Save</button>
                </div>
            </form>
        </x-modal>
    </body>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#supplier-search').on('keyup', function() {
                let searchTerm = $(this).val().toLowerCase(); // Ambil nilai input pencarian
                $('#supplier-list .supplier-item').each(function() {
                    let supplierName = $(this).data('supplier_name')
                        .toLowerCase(); // Ambil nama obat dari data atribut
                    // Tampilkan/hilangkan item berdasarkan pencarian
                    if (supplierName.includes(searchTerm)) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            });
        });
    </script>
</x-app-layout>
