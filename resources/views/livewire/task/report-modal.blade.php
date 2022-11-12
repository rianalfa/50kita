<div>
    <x-modal.header title="Tambah Progress"></x-modal.header>
    <x-modal.body>
        <x-input.wrapper>
            <x-input.label for="report.progress" value="Progress" />
            <x-input.select name="progress" wire:model.defer="report.progress">
                @for ($i=0; $i<=10; $i++)
                    <option value="{{ $i*10 }}">{{ $i*10 }}%</option>
                @endfor
            </x-input.select>
            <x-input.error for="report.progress" />
        </x-input.wrapper>

        <x-input.wrapper>
            <x-input.label for="report.description" value="Deskripsi" />
            <x-input.textarea name="description" wire:model.defer="report.description"></x-input.textarea>
            <x-input.error for="report.description" />
        </x-input.wrapper>
    </x-modal.body>
    <x-modal.footer bordered>
        <x-button.primary wire:click="saveReport()">Simpan</x-button.primary>
    </x-modal.footer>
</div>
