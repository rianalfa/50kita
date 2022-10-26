<div>
    <x-modal.header title="Adukan Gangguan" bordered />
    <x-modal.body class="flex flex-col space-y-4">
        <x-input.wrapper>
            <x-input.label for="interference.category" value="Kategori" />
            <x-input.select wire:model.defer="interference.category">
                <option value="" disabled hidden>-</option>
                @foreach (RequestConstant::allCategories() as $category)
                    <option value="{{ $category }}">{{ $category }}</option>
                @endforeach
            </x-input.select>
            <x-input.error for="interference.category" />
        </x-input.wrapper>

        <x-input.wrapper>
            <x-input.label for="interference.title" value="Judul" />
            <x-input.text wire:model.defer="interference.title" placeholder="Judul permintaan..." />
            <x-input.error for="interference.title" />
        </x-input.wrapper>

        <x-input.wrapper>
            <x-input.label for="interference.description" value="Deskripsi" />
            <x-input.textarea wire:model.defer="interference.description"></x-input.textarea>
            <x-input.error for="interference.description" />
        </x-input.wrapper>

        <x-input.file model="interferenceFile" label="Lampiran (opsional)" />
    </x-modal.body>

    <x-modal.footer bordered>
        <x-button.primary wire:click="saveInterference()">Adukan Gangguan</x-button.primary>
    </x-modal.footer>
</div>
