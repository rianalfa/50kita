<div>
    <x-modal.header title="Pekerjaan"></x-modal.header>
    <x-modal.body>
        <x-input.wrapper>
            <x-input.label for="task.title" value="Judul" />
            <x-input.text name="title" wire:model.defer="task.title" />
            <x-input.error for="task.title" />
        </x-input.wrapper>

        <x-input.wrapper>
            <x-input.label for="task.start_from" value="Tanggal Mulai" />
            <x-input.text type="date" name="start_from" wire:model.defer="task.start_from" />
            <x-input.error for="task.start_from" />
        </x-input.wrapper>

        <x-input.wrapper>
            <x-input.label for="task.due_date" value="Tanggal Selesai" />
            <x-input.text type="date" name="due_date" wire:model.defer="task.due_date" />
            <x-input.error for="task.due_date" />
        </x-input.wrapper>

        <x-input.wrapper>
            <x-input.label for="task.description" value="Deskripsi" />
            <x-input.text name="description" wire:model.defer="task.description" />
            <x-input.error for="task.description" />
        </x-input.wrapper>
    </x-modal.body>
    <x-modal.footer bordered>
        <x-button.primary wire:click="saveTask()">Simpan</x-button.primary>
    </x-modal.footer>
</div>
