<div>
    <x-modal.header title="Pesan ditolak" />
    <x-modal.body>
        <x-input.wrapper>
            <x-input.textarea wire:model.defer="message"></x-input.textarea>
            <x-input.error for="message" />
        </x-input.wrapper>
    </x-modal.body>
    <x-modal.footer bordered>
        <x-button.success wire:click="rejectInterference()">Tolak</x-button.success>
    </x-modal.footer>
</div>
