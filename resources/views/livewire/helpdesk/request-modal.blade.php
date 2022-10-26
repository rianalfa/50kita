<div>
    <x-modal.header title="Ajukan Permintaan" bordered />
    <x-modal.body class="flex flex-col space-y-4">
        <x-input.wrapper>
            <x-input.label for="request.category" value="Kategori" />
            <x-input.select wire:model="request.category">
                <option value="" disabled hidden>-</option>
                @foreach (ResultConstant::allCategories() as $category)
                    <option value="{{ $category }}">{{ $category }}</option>
                @endforeach
            </x-input.select>
            <x-input.error for="request.category" />
        </x-input.wrapper>

        <x-input.wrapper>
            <x-input.label for="request.subcategory" value="Subkategori" />
            <x-input.select wire:model.defer="request.subcategory">
                <option value="" disabled hidden>-</option>
                @forelse ((ResultConstant::subcategories($request->category) ?? []) as $subcategory)
                    <option value="{{ $subcategory }}">{{ $subcategory }}</option>
                @empty
                @endforelse
            </x-input.select>
            <x-input.error for="request.subcategory" />
        </x-input.wrapper>

        <x-input.wrapper>
            <x-input.label for="request.title" value="Judul" />
            <x-input.text wire:model.defer="request.title" placeholder="Judul permintaan..." />
            <x-input.error for="request.title" />
        </x-input.wrapper>

        <x-input.wrapper>
            <x-input.label for="request.description" value="Deskripsi" />
            <x-input.textarea wire:model.defer="request.description"></x-input.textarea>
            <x-input.error for="request.description" />
        </x-input.wrapper>

        <x-input.file model="requestFile" label="Lampiran (opsional)" />
    </x-modal.body>

    <x-modal.footer bordered>
        <x-button.primary wire:click="saveRequest()">Ajukan Permintaan</x-button.primary>
    </x-modal.footer>
</div>
