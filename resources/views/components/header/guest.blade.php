<div class="fixed w-full z-20 top-0 left-0">
    <nav class="bg-white border-b shadow">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 h-16">
                <div class="flex items-center">
                    <div class="hidden md:block flex-shrink-0 md:border-b-2 border-white text-gray-600">
                        <div class="hidden md:block">
                            <x-logo.text />
                        </div>
                    </div>
                    <div class="ml-0 md:ml-10 flex items-stretch space-x-4 h-16">
                        <x-header.item menu="Home" href="{{ route('home') }}" :active="request()->routeIs('home')" />
                        <x-header.item menu="About Us" href="{{ route('about') }}"
                            :active="request()->routeIs('about')" />
                    </div>
                </div>
                <div class="flex items-center justify-end">
                    @auth
                        <div class="ml-4 flex items-center mx-3">
                            @livewire('notifications.header', key($user->id))
                        </div>
                        <ul class="flex items-center">
                            <x-header.profile />
                        </ul>
                    @else
                        <x-anchor.secondary class="whitespace-nowrap" href="{{ route('login') }}">Log in
                        </x-anchor.secondary>
                        <x-anchor.primary class="ml-2" href="{{ route('register') }}">Register
                        </x-anchor.primary>
                    @endauth
                </div>
            </div>
        </div>
    </nav>
</div>
