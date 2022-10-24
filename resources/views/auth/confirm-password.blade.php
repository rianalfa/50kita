<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <img src="{{ asset('storage/images/Logo BPS - Vertikal.png') }}" class="w-24" />
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            Silahkan konfirmasi terlebih dahulu
        </div>

        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <x-input.wrapper>
                <x-input.label for="password" value="Password" />
                <x-input.password id="password" name="password" required autocomplete="current-password" />
                <x-input.error for="password" />
            </x-input.wrapper>

            <div class="flex justify-end mt-4">
                <x-button.primary type="submit">Konfirmasi</x-button.primary>
                <x-jet-button class="ml-4">
                    {{ __('Confirm') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
