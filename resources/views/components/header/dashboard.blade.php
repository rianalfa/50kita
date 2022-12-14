<div class="py-2 pl-2 lg:pl-0 pr-2">
    <nav class="bg-white border-b shadow rounded-md">
        <div class="2xl:container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0 md:border-b-2 border-white text-gray-600">
                        <div class="">
                            <img src="{{ asset('storage/images/Logo BPS - Vertikal.png') }}" class="w-12" />
                        </div>
                    </div>
                </div>
                <div class="flex">
                    <div class="ml-4 flex items-center mx-3">
                        @livewire('notifications.header', key($user->id))
                    </div>
                    <div class="hidden xl:block">
                        <ul class="flex items-center">
                            <x-header.profile />
                        </ul>
                    </div>
                    <div class="-mr-2 flex xl:hidden">
                        <button type="button" x-on:click="toggleSideMenu"
                            class="bg-white inline-flex items-center justify-center p-2 rounded-md text-gray-800 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:border-blue-400 focus:ring-blue-300"
                            aria-controls="mobile-menu" aria-expanded="false">
                            <span class="sr-only">Open main menu</span>

                            <svg x-show="!isSideMenuOpen" class="h-6 w-6" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                            <svg x-show="isSideMenuOpen" class="h-6 w-6" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" x-cloak />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </nav>
</div>
