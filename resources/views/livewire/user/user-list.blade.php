<div>
    @role('admin')
        <div class="flex justify-end align-center mb-4">
            <x-button.primary wire:click="$emit('openModal', 'user.mitra-modal')">Tambah Mitra</x-button.primary>
        </div>
    @endrole

    @livewire('user.user-table')
</div>
