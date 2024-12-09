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
