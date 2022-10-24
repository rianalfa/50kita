<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <img src="{{ asset('storage/images/Logo BPS - Vertikal.png') }}" class="w-24" />
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            Silahkan masukkan email yang Anda gunakan ketika mendaftar untuk mengatur ulang password anda.
        </div>

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <x-input.wrapper>
                <x-input.label for="email" value="Email" />
                <x-input.text id="email" name="email" type="email" :value="old('email')" required autofocus />
                <x-input.error for="email" />
            </x-input.wrapper>

            <div class="flex items-center justify-end mt-4">
                <x-button.primary type="submit">Kirim email</x-button.primary>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
