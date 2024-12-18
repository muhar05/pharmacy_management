<x-modal name="delete-sale-modal">
    <div class="p-6" x-data="{ id: null }" x-on:set-sale-data.window="id = $event.detail.id;">
        <h1 class="text-xl text-white mb-6">Are you sure you want to delete this sale?</h1>
        <form :action="`{{ route('sale.delete', '') }}/${id}`" method="POST">
            @csrf
            @method('DELETE')
            <x-danger-button class="ms-3">
                {{ __('Delete Sale') }}
            </x-danger-button>
        </form>
    </div>
</x-modal>
