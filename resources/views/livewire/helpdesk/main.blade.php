<div class="flex flex-col relative" x-data="{type: 0}">
    <div class="absolute flex flex-col md:flex-row justify-center items-center space-y-4 md:space-y-0 space-x-0 md:space-x-16 w-full" x-show="type==0"
        x-transition:enter="transition ease-out duration-300 delay-200" x-transition:enter-start="scale-50 opacity-0" x-transition:enter-end="scale-100 opacity-100"
        x-transition:leave="transition ease-in duration-200" x-transition:leave-start="scale-100 opacity-100" x-transition:leave-end="scale-150 opacity-0">
        <x-card.base class="flex flex-col justify-center space-y-4 md:space-y-8 text-center w-full max-w-xs cursor-pointer
            hover:scale-105 transition-transform duration-200 delay-75"
            x-on:click="type = 1">
            <p class="text-xl md:text-2xl text-blue-600 font-semibold underline underline-offset-8">Permintaan</p>
            <i class="fa-solid fa-suitcase text-4xl md:text-7xl bg-blue-600 bg-clip-text text-transparent"></i>
            <p>Permintaan layanan sesuai kebutuhan Anda</p>
        </x-card.base>
        <x-card.base class="flex flex-col justify-center space-y-4 md:space-y-8 text-center w-full max-w-xs cursor-pointer
            hover:scale-105 transition-transform duration-200 delay-75"
            x-on:click="type = 2">
            <p class="text-xl md:text-2xl text-blue-600 font-semibold underline underline-offset-8">Gangguan</p>
            <i class="fa-solid fa-user-gear text-4xl md:text-7xl bg-blue-600 bg-clip-text text-transparent"></i>
            <p>Laporkan masalah Anda ke tim dukungan kami</p>
        </x-card.base>
    </div>

    <div class="absolute flex flex-col justify-center space-y-4 md:space-y-8 w-full" x-show="type==1"
        x-transition:enter="transition ease-out duration-300 delay-200" x-transition:enter-start="scale-50 opacity-0" x-transition:enter-end="scale-100 opacity-100"
        x-transition:leave="transition ease-in duration-200" x-transition:leave-start="scale-100 opacity-100" x-transition:leave-end="scale-150 opacity-0">
        <div class="flex justify-end items-center w-full">
            <x-button.primary wire:click="$emit('openModal', 'helpdesk.request.form-modal')">Ajukan Permintaan</x-button.primary>
        </div>
        <div class="flex w-full">
            @php
                if (auth()->user()->hasRole('admin')) {
                    $requests = \App\Models\Request::first() ?? [];
                } else {
                    $requests = \App\Models\Request::where('user_id', auth()->user()->id)
                                    ->first() ?? [];
                }
            @endphp

            @if (!empty($requests))
                <div class="w-full max-w-full">
                    @livewire('helpdesk.request.table')
                </div>
            @else
                <x-empty />
            @endif
        </div>
    </div>

    <div class="absolute flex flex-col justify-center space-y-4 md:space-y-8 w-full" x-show="type==2"
        x-transition:enter="transition ease-out duration-300 delay-200" x-transition:enter-start="scale-50 opacity-0" x-transition:enter-end="scale-100 opacity-100"
        x-transition:leave="transition ease-in duration-200" x-transition:leave-start="scale-100 opacity-100" x-transition:leave-end="scale-150 opacity-0">
        <div class="flex justify-end items-center w-full">
            <x-button.primary wire:click="$emit('openModal', 'helpdesk.interference.form-modal')">Adukan Gangguan</x-button.primary>
        </div>
        <div class="flex w-full">
            @php
                $interferences = \App\Models\Interference::first() ?? [];
            @endphp

            @if (!empty($interferences))
                <div class="w-full max-w-full">
                    @livewire('helpdesk.interference.table')
                </div>
            @else
                <x-empty />
            @endif
        </div>
    </div>
</div>
