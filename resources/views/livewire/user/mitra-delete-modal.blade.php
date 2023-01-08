<div>
    <x-modal.header title="Hapus Mitra" />
    <x-modal.body>
        <p>Apakah Anda yakin ingin menghapus mitra dengan nama <span class="text-red-500">{{ $user->name }}</span>?</p>
    </x-modal.body>
    <x-modal.footer>
        <x-button.secondary wire:click="$emit('closeModal')">Batal</x-button.secondary>
        <x-button.error class="ml-2" wire:click="deleteMitra">Hapus</x-button.error>
    </x-modal.footer>
</div>
