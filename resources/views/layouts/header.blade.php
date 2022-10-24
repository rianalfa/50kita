<div class="fixed bg-white shadow-md w-full t-bold mb-4 z-50" wire:ignore>
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="flex justify-between items-center py-4 md:justify-start md:space-x-10">
            <div class="flex justify-start flex-1">
                <a href="#">
                    <x-logos.icon />
                </a>
            </div>
            <div class="hidden xl:flex items-center space-x-10">
                {{ $slot }}
            </div>
            <div class="flex justify-end ml-0">
                @auth
                    <div class="flex items-center">
                        @livewire('notifications.header', key(auth()->user()->id))
                    </div>
                    <div class="block lg:mx-3">
                        <ul class="flex items-center">
                            <x-headers.profile />
                        </ul>
                    </div>
                @endauth
                <div class="-mr-2 flex xl:hidden">
                    <button type="button" x-on:click="toggleSideMenu"
                        class="inline-flex items-center justify-center p-2 rounded-md text-white hover:text-gray-300"
                        aria-controls="mobile-menu" aria-expanded="false">
                        <span class="sr-only">Open main menu</span>

                        <svg x-show="!isSideMenuOpen" class="text-gray-500 h-6 w-6" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        <svg x-show="isSideMenuOpen" class="text-gray-500 h-6 w-6" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" x-cloak />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
