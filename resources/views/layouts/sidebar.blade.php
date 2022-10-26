<div class="fixed lg:relative left-0 flex-shrink-0 w-64 lg:p-2 z-[999]">
    <aside class="absolute inset-y-2 z-20 flex-shrink-0 rounded-md w-full max-w-[15rem] mx-auto overflow-y-auto bg-blue-600 hidden lg:block scroll-style shadow-md shadow-blue-300">
        <div class="text-gray-500 dark:text-gray-400">
            <a class="flex items-center justify-center bg-white text-blue-600 rounded-t-md p-4" href="#">
                <x-logo.text />
            </a>
            <ul class="flex flex-col space-y-2 mt-10" id="mobile-sidebar">
                {{ $slot }}
            </ul>
        </div>
    </aside>
    <aside
        class="fixed inset-y-0 z-50 flex-shrink-0 w-64 overflow-y-auto bg-blue-600 lg:hidden scroll-style shadow-md shadow-blue-300"
        x-show="isSideMenuOpen" x-transition:enter="transition ease-in-out duration-150"
        x-transition:enter-start="opacity-0 transform -translate-x-20" x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in-out duration-150" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0 transform -translate-x-20" @click.away="closeSideMenu"
        @keydown.escape="closeSideMenu" x-cloak>
        <div class="text-gray-600">
            <a class="flex justify-center items-center bg-white text-blue-600 p-4" href="#">
                <x-logo.text />
            </a>

            <ul class="flex flex-col space-y-2 mt-10" id="mobile-sidebar">
                {{ $slot }}
            </ul>

        </div>
    </aside>
</div>
