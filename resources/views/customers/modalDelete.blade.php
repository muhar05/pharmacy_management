<x-modal name="delete-customer-modal">
    <div class="p-6" x-data="{ id: null }" x-on:set-customer-data.window="id = $event.detail.id;">
        <h1 class="text-xl text-white mb-6">Are you sure you want to delete this customer?</h1>
        <form :action="`{{ route('customer.delete', '') }}/${id}`" method="POST">
            @csrf
            @method('DELETE')
            <x-danger-button class="ms-3">
                {{ __('Delete Customer') }}
            </x-danger-button>
        </form>
    </div>
</x-modal>
