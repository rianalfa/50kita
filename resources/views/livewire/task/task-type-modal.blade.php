<div>
    <x-modal.header title="Jenis Tugas" />
    <x-modal.body>
        <x-input.wrapper>
            <x-input.label for="taskType.title" value="Nama" />
            <x-input.text name="title" wire:model.defer="taskType.title" />
            <x-input.error for="taskType.title" />
        </x-input.wrapper>
        <x-input.wrapper>
            <x-input.label for="taskType.description" value="Deskripsi" />
            <x-input.text name="description" wire:model.defer="taskType.description" />
            <x-input.error for="taskType.description" />
        </x-input.wrapper>
    </x-modal.body>
    <x-modal.footer class="flex-end">
        <x-button.primary wire:click="saveType">Simpan</x-button.primary>
    </x-modal.footer>
</div>
