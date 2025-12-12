{{-- resources/views/medicines/partials/table.blade.php --}}
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