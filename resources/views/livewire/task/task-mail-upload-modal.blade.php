<div>
    <x-modal.header title="Unggah Surat" />
    <x-modal.body>
        <x-input.wrapper>
            <x-input.file model="mailFile" label="Surat" />
        </x-input.wrapper>
    </x-modal.body>
    <x-modal.footer class="flex-end">
        <x-button.primary wire:click="uploadMail">Unggah</x-button.primary>
    </x-modal.footer>
</div>
