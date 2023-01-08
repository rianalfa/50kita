<div>
    <x-modal.header title="Mitra" />
    <x-modal.body>
        <x-input.wrapper>
            <x-input.label for="user.name" value="Nama" />
            <x-input.text name="user.name" wire:model.defer="user.name" />
            <x-input.error for="user.name" />
        </x-input.wrapper>

        <x-input.wrapper>
            <x-input.label for="user.username" value="Username" />
            <x-input.text name="user.username" wire:model.defer="user.username" />
            <x-input.error for="user.username" />
        </x-input.wrapper>

        <x-input.wrapper>
            <x-input.label for="user.email" value="Email" />
            <x-input.text name="user.email" wire:model.defer="user.email" />
            <x-input.error for="user.email" />
        </x-input.wrapper>

        <x-input.wrapper>
            <x-input.label for="user.phone_number" value="Nomor HP" />
            <x-input.text name="user.phone_number" wire:model.defer="user.phone_number" />
            <x-input.error for="user.phone_number" />
        </x-input.wrapper>

        <x-input.wrapper>
            <x-input.label for="subvillage" value="Jorong" />
            <x-input.select name="subvillage" wire:model.defer="subvillage">
                @foreach (AddressConstant::subvillages() as $subvillage)
                    <option value="{{ $subvillage }}"> {{ $subvillage }}</option>
                @endforeach
            </x-input.select>
            <x-input.error for="subvillage" />
        </x-input.wrapper>

        <x-input.wrapper>
            <x-input.label for="village" value="Nagari" />
            <x-input.select name="village" wire:model.defer="village">
                @foreach (AddressConstant::villages() as $village)
                    <option value="{{ $village }}">{{ $village }}</option>
                @endforeach
            </x-input.select>
            <x-input.error for="village" />
        </x-input.wrapper>

        <x-input.wrapper>
            <x-input.label for="district" value="Kecamatan" />
            <x-input.select name="district" wire:model.defer="district">
                @foreach (AddressConstant::districts() as $district)
                    <option value="{{ $district }}">{{ $district }}</option>
                @endforeach
            </x-input.select>
            <x-input.error for="district" />
        </x-input.wrapper>
    </x-modal.body>
    <x-modal.footer>
        <x-button.secondary wire:click="$emit('closeModal')">Batal</x-button.secondary>
        <x-button.primary class="ml-2" wire:click="saveMitra">Simpan</x-button.primary>
    </x-modal.footer>
</div>
