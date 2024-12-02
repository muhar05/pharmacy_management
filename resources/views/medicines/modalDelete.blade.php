<x-modal name="delete-medicine-modal">
    <div class="p-6" x-data="{ id: null }" x-on:set-medicine-data.window="id = $event.detail.id;">
        <h1 class="text-xl text-white mb-6">Are you sure you want to delete this medicine?</h1>
        <form :action="`{{ route('medicine.delete', '') }}/${id}`" method="POST">
            @csrf
            @method('DELETE')
            <x-danger-button class="ms-3">
                {{ __('Delete Medicine') }}
            </x-danger-button>
        </form>
    </div>
</x-modal>
