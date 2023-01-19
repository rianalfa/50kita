<div>
    <x-modal.header title="Pembayaran" />
    <x-modal.body>
        <x-input.wrapper>
            <x-input.label for="payment.amount" value="Jumlah Terhitung (Rp)" />
            <x-input.text name="payment.amount" wire:model.defer="payment.amount" />
            <x-input.error for="payment.amount" />
        </x-input.wrapper>

        <x-input.wrapper>
            <x-input.label for="payment.amount_text" value="Jumlah Terbilang (Rp)" />
            <x-input.text name="payment.amount_text" wire:model.defer="payment.amount_text" />
            <x-input.error for="payment.amount_text" />
        </x-input.wrapper>

        <div class="flex flex-col space-y-4">
            @foreach ($descriptions as $key => $description)
                <x-card.base>
                    <div class="flex justify-end w-full mb-1">
                        <i class="fa-solid fa-xmark text-gray-400 text-xl cursor-pointer hover:text-red-500"
                            wire:click="deleteDescription({{ $key }})"></i>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-4 items-center gap-4">
                        <x-input.label for="descriptions.{{ $key }}.text" value="Uraian" />
                        <x-input.text name="descriptions.{{ $key }}.text" wire:model.defer="descriptions.{{ $key }}.text" class="lg:col-span-3" />
                        <x-input.error for="descriptions.{{ $key }}.text" class="lg:col-span-4" />
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-4 items-center gap-4">
                        <x-input.label for="descriptions.{{ $key }}.amount" value="Jumlah Terbilang (Rp)" />
                        <x-input.text name="descriptions.{{ $key }}.amount" wire:model.defer="descriptions.{{ $key }}.amount" class="lg:col-span-3" />
                        <x-input.error for="descriptions.{{ $key }}.amount" class="lg:col-span-4" />
                    </div>
                </x-card.base>
            @endforeach
        </div>
    </x-modal.body>
    <x-modal.footer class="flex-end">
        <x-button.secondary wire:click="addDescription">+ Uraian</x-button.secondary>
        <x-button.primary wire:click="savePayment" class="ml-4">Simpan</x-button.primary>
    </x-modal.footer>
</div>
