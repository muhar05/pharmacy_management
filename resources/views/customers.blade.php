<x-app-layout>

    <body>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Customers') }}
            </h2>
        </x-slot>
        <main class="mt-10 w-full h-full pb-6">
            <div class="max-w-7xl mx-auto sm:px-4 lg:px-8">
                <div>
                    <h1 class="text-balance p-4 text-5xl font-semibold tracking-tight text-gray-200 sm:text-3xl">Table of
                        Customers</h1>
                    <div class="mt-6 w-full">
                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                            <div
                                class="flex items-center justify-between flex-column flex-wrap md:flex-row space-y-4 md:space-y-0 pb-4 bg-white dark:bg-gray-900">
                                <div class="mb-4 flex justify-end w-full">
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
                                                <a href="{{ route('customers.export-xlsx') }}"
                                                    class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                                                    Export XLSX
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ route('customers.export-pdf') }}"
                                                    class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                                                    Export PDF
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <label for="table-search" class="sr-only">Search</label>
                                <div class="relative w-full">
                                    <div
                                        class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                        </svg>
                                    </div>
                                    <input type="text" id="customer-search"
                                        class="block w-full p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="Search for customers">
                                </div>
                            </div>
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                <thead
                                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">Name</th>
                                        <th scope="col" class="px-6 py-3">Phone</th>
                                        <th scope="col" class="px-6 py-3">Address</th>
                                        <th scope="col" class="px-6 py-3">Disease</th>
                                        <th scope="col" class="px-6 py-3">Created At</th>
                                        <th scope="col" class="px-6 py-3">Updated At</th>
                                        <th scope="col" class="px-6 py-3">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="customer-list">
                                    @if ($customers->isEmpty())
                                        <tr>
                                            <td colspan="7"
                                                class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                                Tidak ada data pelanggan.
                                            </td>
                                        </tr>
                                    @else
                                        @foreach ($customers as $customer)
                                            <tr class="customer-item bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600"
                                                data-customer_name="{{ $customer->name }}">
                                                <td class="px-6 py-4">
                                                    {{ $customer->name }}
                                                </td>
                                                <td class="px-6 py-4">
                                                    {{ $customer->phone }}
                                                </td>
                                                <td class="px-6 py-4">
                                                    {{ $customer->address }}
                                                </td>
                                                <td class="px-6 py-4">
                                                    {{ $customer->disease ?? '-' }}
                                                </td>
                                                <td class="px-6 py-4">
                                                    <div class="flex items-center">
                                                        <div class="h-2.5 w-2.5 rounded-full bg-green-500 me-2"></div>
                                                        {{ $customer->created_at->diffForHumans() }}
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4">
                                                    <div class="flex items-center">
                                                        <div class="h-2.5 w-2.5 rounded-full bg-green-500 me-2"></div>
                                                        {{ $customer->updated_at->diffForHumans() }}
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 flex gap-4">
                                                    <button type="button" x-data
                                                        x-on:click.prevent="
                                                                    $dispatch('open-modal', 'edit-customer-modal');
                                                                    $dispatch('set-customer-data', {
                                                                        id: {{ $customer->id }},
                                                                        customer_name: '{{ $customer->name }}',
                                                                        phone: '{{ $customer->phone }}',
                                                                        address: `{{ addslashes($customer->address) }}`,
                                                                        disease: '{{ $customer->disease ?? '' }}'
                                                                    })
                                                                "
                                                        class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit
                                                        Customer</button>
                                                    <button type="button" x-data
                                                        x-on:click.prevent="$dispatch('open-modal', 'delete-customer-modal');
                                                                    $dispatch('set-customer-data', {
                                                                        id: {{ $customer->id }},
                                                                    })"
                                                        class="font-medium text-red-500 dark:text-red-500 hover:underline"
                                                        href="">Delete Customer</button>
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
        </main>
        @include('customers.modalEdit')

        @include('customers.modalDelete')
    </body>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#customer-search').on('keyup', function() {
                let searchTerm = $(this).val().toLowerCase(); // Ambil nilai input pencarian
                $('#customer-list .customer-item').each(function() {
                    let customerName = $(this).data('customer_name')
                        .toLowerCase(); // Ambil nama obat dari data atribut
                    // Tampilkan/hilangkan item berdasarkan pencarian
                    if (customerName.includes(searchTerm)) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            });
        });
    </script>
</x-app-layout>
