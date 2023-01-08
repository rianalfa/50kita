<div>
    <x-modal.header title="Ubah Jabatan User" />
    <x-modal.body>
        <X-input.wrapper>
            <x-input.select name="role" wire:model.defer="role">
                <option value="admin">Admin</option>
                <option value="user">Pegawai</option>
                <option value="mitra">Mitra</option>
            </x-input.select>
        </X-input.wrapper>
    </x-modal.body>
    <x-modal.footer>
        <x-button.secondary wire:click="$emit('closeModal')">Batal</x-button.secondary>
        <x-button.primary class="ml-2" wire:click="saveRole">Simpan</x-button.primary>
    </x-modal.footer>
</div>
