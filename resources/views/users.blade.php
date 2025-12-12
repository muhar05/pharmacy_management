<x-app-layout>

    <head>
        <title>Customers</title>
    </head>

    <body>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Users') }}
            </h2>
        </x-slot>

        <main class="mt-10 w-full h-full">
            <div class="max-w-7xl mx-auto sm:px-4 lg:px-8">
                <div>
                    {{-- Tambahkan di bagian atas halaman users.blade.php --}}
                    <div class="flex justify-between items-center mb-6">
                        <h1 class="text-balance p-4 text-5xl font-semibold tracking-tight text-gray-200 sm:text-3xl">Table of
                        Users</h1>
                        <a href="{{ route('users.create') }}"
                           class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-md shadow transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                            </svg>
                            Add User
                        </a>
                    </div>

                    <div class="mt-6 w-full pb-6">
                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                            <div
                                class="flex items-center justify-between flex-column flex-wrap md:flex-row space-y-4 md:space-y-0 pb-4 bg-white dark:bg-gray-900">
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
                                    <input type="text" id="user-search"
                                        class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-full bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="Search for users">
                                </div>
                            </div>
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                <thead
                                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            Name and Email
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Name
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Position
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Created At
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Updated At
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="user-list">
                                    @if ($users->isEmpty())
                                        <tr>
                                            <td colspan="6"
                                                class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                                Tidak ada data pengguna.
                                            </td>
                                        </tr>
                                    @else
                                        @foreach ($users as $user)
                                            <tr data-user_name="{{ $user->name }}"
                                                class="user-item bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                                <th scope="row"
                                                    class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                                                    <div class="ps-3">
                                                        <div class="text-base font-semibold">{{ $user->name }}</div>
                                                        <div class="font-normal text-gray-500">{{ $user->email }}</div>
                                                    </div>
                                                </th>
                                                <td class="px-6 py-4">
                                                    {{ $user->name }}
                                                </td>
                                                <td>
                                                    {{ $user->position }}
                                                </td>
                                                <td class="px-6 py-4">
                                                    <div class="flex items-center">
                                                        <div class="h-2.5 w-2.5 rounded-full bg-green-500 me-2"></div>
                                                        {{ $user->created_at->diffForHumans() }}
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4">
                                                    <div class="flex items-center">
                                                        <div class="h-2.5 w-2.5 rounded-full bg-green-500 me-2"></div>
                                                        {{ $user->updated_at->diffForHumans() }}
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 flex justify-around">
                                                    @if ($user->id !== auth()->id())
                                                        <button type="button" x-data
                                                            x-on:click.prevent="
                                                            $dispatch('open-modal', 'edit-user-modal');
                                                            $dispatch('set-user-data', {
                                                                id: {{ $user->id }},
                                                                position: '{{ $user->position }}'
                                                            })
                                                        "
                                                            class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                                            Edit User
                                                        </button>
                                                    @else
                                                        <span class="text-gray-400 dark:text-gray-500">
                                                            Cannot edit your own account
                                                        </span>
                                                    @endif
                                                    @if ($user->id !== auth()->id())
                                                        <button type="button" x-data
                                                            x-on:click.prevent="
                                                            $dispatch('open-modal', 'delete-user-modal');
                                                            $dispatch('set-user-data', {
                                                                id: {{ $user->id }},
                                                            })
                                                        "
                                                            class="font-medium text-red-500 dark:text-red-500 hover:underline">
                                                            Delete User
                                                        </button>
                                                    @else
                                                        <span class="text-gray-400 dark:text-gray-500">
                                                            Cannot delete your own account
                                                        </span>
                                                    @endif
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

        @include('users.modalEdit')

        @include('users.modalDelete')
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#user-search').on('keyup', function() {
                    let searchTerm = $(this).val().toLowerCase(); // Ambil nilai input pencarian
                    $('#user-list .user-item').each(function() {
                        let userName = $(this).data('user_name')
                            .toLowerCase(); // Ambil nama obat dari data atribut
                        // Tampilkan/hilangkan item berdasarkan pencarian
                        if (userName.includes(searchTerm)) {
                            $(this).show();
                        } else {
                            $(this).hide();
                        }
                    });
                });
            });
        </script>
    </body>
</x-app-layout>
