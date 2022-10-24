<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <img src="{{ asset('storage/images/Logo BPS - Vertikal.png') }}" class="w-24" />
        </x-slot>

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <x-input.wrapper>
                <x-input.label for="username" value="Username" />
                <x-input.text id="username" name="username" :value="old('username')" required autofocus />
                <x-input.error for="username" />
            </x-input.wrapper>

            <x-input.wrapper>
                <x-input.label for="password" value="Password" />
                <x-input.password id="password" name="password" :value="old('password')" required />
                <x-input.error for="password" />
            </x-input.wrapper>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-input.checkbox id="remember_me" name="remember" />
                    <span class="ml-2 text-sm text-gray-600">{{ __('Ingat saya') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-between mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('register') }}">
                    Daftar
                </a>
                <div class="flex justify-end items-center space-x-4">
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                            {{ __('Lupa password?') }}
                        </a>
                    @endif

                    <x-button.primary type="submit">Log In</x-button.primary>
                </div>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
