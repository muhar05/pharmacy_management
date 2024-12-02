<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Halo, {{ Auth::user()->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="container mx-auto px-4 py-8">
                        <h2 class="text-2xl font-bold mb-6">
                            Feature of Apotek Management
                        </h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-4">
                            <a href="{{ route('cashier') }}"
                                class="flex flex-col items-center justify-center p-4 rounded-lg bg-gray-800 hover:bg-gray-700 cursor-pointer">
                                <svg class="w-[36px] h-[36px] text-gray-800 dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                    viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M5 4h1.5L9 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-8.5-3h9.25L19 7H7.312" />
                                </svg>
                                <h3 class="mt-2 text-lg font-semibold">Cashier</h3>
                            </a>
                            <a href="{{ route('sales') }}"
                                class="flex flex-col items-center justify-center p-4 rounded-lg bg-gray-800 hover:bg-gray-700 cursor-pointer">
                                <svg class="w-[36px] h-[36px] text-gray-800 dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                    viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M10 3v4a1 1 0 0 1-1 1H5m8-2h3m-3 3h3m-4 3v6m4-3H8M19 4v16a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V7.914a1 1 0 0 1 .293-.707l3.914-3.914A1 1 0 0 1 9.914 3H18a1 1 0 0 1 1 1ZM8 12v6h8v-6H8Z" />
                                </svg>
                                <h3 class="mt-2 text-lg font-semibold">Sales Statistics</h3>
                            </a>
                        </div>
                        <div class="w-full bg-slate-800 mt-10 rounded-lg">
                            <div class="w-full flex p-5 justify-start items-center gap-6">
                                <button class="p-3 bg-slate-900 rounded-lg">Daily</button>
                                <button>Weekly</button>
                                <button>Montly</button>
                            </div>
                            <div class="w-full p-6 grid grid-cols-2 gap-5 justify-center items-center text-center">
                                <div class="w-full flex flex-col justify-between col-span-2">
                                    <h1 class="font-semibold text-xl">Sum of Sales : </h1>
                                    <h2 class="font-semibold text-3xl">Rp. 2.000.000</h2>
                                </div>
                                <div class="w-full flex flex-col justify-between">
                                    <h1 class="font-semibold text-xl">Transaction : </h1>
                                    <h2 class="font-semibold text-3xl">50</h2>
                                </div>
                                <div class="w-full flex flex-col justify-between">
                                    <h1 class="font-semibold text-xl">Best Seller : </h1>
                                    <h2 class="font-semibold text-3xl">Paracetamol</h2>
                                </div>
                            </div>
                        </div>
                        <div class="w-full mt-10 flex justify-center gap-5 items-center">
                            <div class="w-full p-4 bg-slate-800 rounded-lg">
                                <h1 class="font-semibold text-lg">Stok Rendah</h1>
                                <ul class="list-disc p-2">
                                    <li>Paracetamol</li>
                                    <li>Aspirin</li>
                                </ul>
                            </div>
                            <div class="w-full p-4 bg-slate-800 rounded-lg">
                                <h1 class="font-semibold text-lg">Kadaluarsa dalam 30 hari</h1>
                                <ul class="list-disc p-2">
                                    <li>Vitamin C (Exp: 2024-12-01)</li>
                                    <li>Aspirin</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
