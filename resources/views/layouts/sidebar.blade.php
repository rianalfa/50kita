<div class="flex-shrink-0 w-64 p-2">
    <aside class="fixed inset-y-2 z-20 flex-shrink-0 rounded-md w-full max-w-[15rem] mx-auto overflow-y-auto bg-gray-700 hidden lg:block border-r-2 border-gray-100 scroll-style shadow-md">
        <div class="py-4 text-gray-500 dark:text-gray-400">
            <a class="ml-6 flex text-white" href="#">
                <x-logo.text />
            </a>
            <ul class="flex flex-col space-y-2 mt-10" id="mobile-sidebar">
                {{ $slot }}
            </ul>
        </div>
    </aside>
    <aside
        class="fixed inset-y-0 z-20 flex-shrink-0 w-64 overflow-y-auto bg-gray-700 lg:hidden border-r-2 border-gray-100 scroll-style shadow-md"
        x-show="isSideMenuOpen" x-transition:enter="transition ease-in-out duration-150"
        x-transition:enter-start="opacity-0 transform -translate-x-20" x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in-out duration-150" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0 transform -translate-x-20" @click.away="closeSideMenu"
        @keydown.escape="closeSideMenu" x-cloak>
        <div class="py-4 text-gray-600">
            <a class="ml-6 flex text-white" href="#">
                <x-logo.text />
            </a>

            <ul class="mt-3" id="mobile-sidebar">
                {{ $slot }}
            </ul>

        </div>
    </aside>
</div>
