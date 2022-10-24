<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <img src="{{ asset('storage/images/Logo BPS - Vertikal.png') }}" class="w-24" />
        </x-slot>

        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <x-input.wrapper>
                <x-input.label for="email" value="Email" />
                <x-input.text id="email" name="email" type="email" :value="old('email', $request->email)" required autofocus />
            </x-input.wrapper>

            <x-input.wrapper>
                <x-input.label for="password" value="Password" />
                <x-input.password id="password" name="password" required autocomplete="new-password" />
                <x-input.error for="password" />
            </x-input.wrapper>

            <x-input.wrapper>
                <x-input.label for="password_confirmation" value="Konfirmasi Password" />
                <x-input.password id="password_confirmation" name="password_confirmation" required autocomplete="current-password" />
                <x-input.error for="password_confirmation" />
            </x-input.wrapper>

            <div class="flex items-center justify-end mt-4">
                <x-button.primary type="submit">Ubah Password</x-button.primary>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
