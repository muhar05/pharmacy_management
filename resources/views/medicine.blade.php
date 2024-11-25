<x-app-layout>

    <body>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ $title }}
            </h2>
        </x-slot>

        <main class="mt-10 w-full h-full">
            <div class="max-w-7xl mx-auto sm:px-4 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h1 class="text-2xl text-white font-semibold">{{ $medicine->name }}</h1>
                    <h2 class="text-xl text-gray-400 font-semibold">{{ $medicine->type }}</h2>
                    <div class="mt-6">
                        <h1 class="text-xl text-gray-400 font-semibold">Keterangan</h1>
                        @if ($medicine->description)
                            <p class="text-white">{{ $medicine->description }}</p>
                        @else
                            <p class="text-white">Tidak ada keterangan</p>
                        @endif
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 mt-6 gap-4">
                            <div class="p-5">
                                <h1 class="text-2xl text-white font-semibold">Expired date :</h1>
                                <p class="text-white text-xl">{{ $medicine->formatted_expiry_date }}</p>
                            </div>
                            <div class="p-5">
                                <h1 class="text-2xl text-white font-semibold">Stock:</h1>
                                <p class="text-white text-xl">{{ $medicine->stock }}</p>
                            </div>
                            <div class="p-5">
                                <h1 class="text-2xl text-white font-semibold">Supplier Name:</h1>
                                <p class="text-white text-xl">{{ $medicine->supplier_name }}</p>
                            </div>
                            <div class="p-5">
                                <h1 class="text-2xl text-white font-semibold">Created At:</h1>
                                <p class="text-white text-xl">{{ $medicine->created_at->diffForHumans() }}</p>
                            </div>
                            <div class="p-5">
                                <h1 class="text-2xl text-white font-semibold">Updated At:</h1>
                                <p class="text-white text-xl">{{ $medicine->updated_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="mt-6 mb-6">
                        <a href="{{ route('medicines') }}"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300">&laquo;
                            Back</a>
                    </div>
                </div>
            </div>
        </main>
    </body>
</x-app-layout>
