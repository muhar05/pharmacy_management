<x-modal name="delete-user-modal">
    <div class="p-6" x-data="{ id: null }" x-on:set-user-data.window="id = $event.detail.id;">
        <h1 class="text-xl text-white mb-6">Are you sure you want to delete this user?</h1>
        <form :action="`{{ route('user.delete', '') }}/${id}`" method="POST">
            @csrf
            @method('DELETE')
            <x-danger-button class="ms-3">
                {{ __('Delete User') }}
            </x-danger-button>
        </form>
    </div>
</x-modal>
