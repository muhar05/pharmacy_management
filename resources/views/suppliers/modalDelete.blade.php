<x-modal name="delete-supplier-modal">
    <div class="p-6" x-data="{ id: null }" x-on:set-supplier-data.window="id = $event.detail.id;">
        <h1 class="text-xl text-white mb-6">Are you sure you want to delete this supplier?</h1>
        <form :action="`{{ route('supplier.delete', '') }}/${id}`" method="POST">
            @csrf
            @method('DELETE')
            <x-danger-button class="ms-3">
                {{ __('Delete Supplier') }}
            </x-danger-button>
        </form>
    </div>
</x-modal>
