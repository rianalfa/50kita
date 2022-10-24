<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <img src="{{ asset('storage/images/Logo BPS - Vertikal.png') }}" class="w-24" />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <x-input.wrapper>
                <x-input.label for="name" value="Nama" />
                <x-input.text id="name" name="name" :value="old('name')" required autofocus autocomplete="name" />
                <x-input.error for="name" />
            </x-input.wrapper>

            <x-input.wrapper>
                <x-input.label for="username" value="Username" />
                <x-input.text id="username" name="username" :value="old('username')" required autocomplete="username" />
                <x-input.error for="username" />
            </x-input.wrapper>

            <x-input.wrapper>
                <x-input.label for="email" value="Email" />
                <x-input.text id="email" name="email" :value="old('email')" required autocomplete="email" />
                <x-input.error for="email" />
            </x-input.wrapper>

            <x-input.wrapper>
                <x-input.label for="password" value="Password" />
                <x-input.password id="password" name="password" required autocomplete="new-password" />
                <x-input.error for="password" />
            </x-input.wrapper>

            <x-input.wrapper>
                <x-input.label for="password_confirmation" value="Konfirmasi Password" />
                <x-input.password id="password_confirmation" name="password_confirmation" required autocomplete="new-password" />
                <x-input.error for="password_confirmation" />
            </x-input.wrapper>

            <div class="flex items-center justify-between mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Sudah daftar?') }}
                </a>

                <x-button.primary type="submit">Daftar</x-button.primary>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
