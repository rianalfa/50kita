<div class="flex flex-col relative space-y-4 md:space-y-8">
    <div class="flex flex-col items-center space-y-0 md:space-y-2">
        <div class="flex justify-center items-center space-x-4 md:space-4">
            <p class="text-xl md:text-3xl font-bold">{{ $team->name }}</p>
            <div class="grid place-content-center bg-{{ $team->color }} rounded-lg md:rounded-2xl w-10 md:w-12 h-10 md:h-12">
                <i class="fa-solid fa-{{ $team->icon }} text-lg md:text-2xl
                    {{ ((int)explode('-', $team->color)[1] >= 500) ? 'text-white' : '' }}"></i>
            </div>
        </div>
        <p class="text-gray-400 text-base md:text-xl font-semibold">RO: {{ $team->ro }}</p>
    </div>
    <p class="text-sm md:text-base text-gray-600 w-full max-w-2xl mx-auto">
        <span class="text-black font-bold">Deskripsi tim:</span>
        {{ $team-> description }}
    </p>
    <div class="flex flex-col justify-center space-y-4">
        <div class="flex justify-between items-center">
            <p class="text-base md:text-lg font-semibold">Anggota</p>
            @if (auth()->user()->hasRole('ipds') || $chief->id==auth()->user()->id)
                <x-button.primary wire:click="$emit('openModal', 'team.team-member-modal', {{ json_encode(['teamId' => $team->id]) }})">
                    + Anggota
                </x-button.primary>
            @endif
        </div>
        <livewire:team.team-members-table id="{{ $team->id }}" />
    </div>
    <div class="flex flex-col justify-center space-y-4">
        <p class="text-base md:text-lg font-semibold">Pekerjaan</p>
        <livewire:team.team-tasks-table id="{{ $team->id }}" />
    </div>
</div>
