<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased">
        <div class="flex h-screen bg-gray-100">
            @include('components.sidebar.nav')
            <div class="flex flex-col flex-1 overflow-x-hidden">
                @include('components.header.dashboard')
                <main class="h-full overflow-y-auto pt-4">
                    <div class="xl:container mx-auto px-4 md:px-6 lg:px-8 pt-4 pb-8">
                        {{ $slot }}
                    </div>
                </main>
            </div>
        </div>
        <div class="modal-center z-30">
            @livewire('livewire-ui-modal')
        </div>

        @stack('modals')

        @livewireScripts
        @stack('scripts')
    </body>
</html>
