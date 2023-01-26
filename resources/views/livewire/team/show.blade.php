<div class="flex flex-col space-y-4 md:space-y-8 relative" x-data="{ openTaskType: false }">
    <div class="flex flex-col md:flex-row justify-between items-center">
        <x-input.toggle text="Tim Saya" wire:model="myTeams" />
        @role('admin')
            <div class="flex space-x-4">
                <x-button.secondary @click="openTaskType = !openTaskType">
                    Jenis Tugas
                </x-button.secondary>

                <x-button.primary wire:click="$emit('openModal', 'team.team-modal')">
                    Buat Tim
                </x-button.primary>
            </div>
        @endrole
    </div>

    @role('admin')
        <div class="grid place-items-center" x-show="openTaskType"
            x-transition:enter="transition ease-in-out duration-150"
            x-transition:enter-start="opacity-0 -translate-y-28" x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in-out duration-150"
            x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-28"
            @keydown.escape="openTaskType = false"
        >
            <livewire:task.task-type-show />
        </div>
    @endrole

    @if (sizeof($teams) != 0)
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 lg:gap-8">
            @foreach ($teams as $team)
                <div class="relative hover:scale-105 transition-transform duration-200 delay-75">
                    <div class="absolute top-4 right-4">
                        <x-jet-dropdown>
                            <x-slot name="trigger">
                                <x-button.white>
                                    <i class="fa-solid fa-ellipsis-vertical text-gray-400"></i>
                                </x-button.white>
                            </x-slot>

                            <x-slot name="content">
                                <div class="flex flex-col justify-center items-center space-y-2 p-2">
                                    <x-badge.success class="cursor-pointer w-16 hover:scale-105 transition-transform duration-200 delay-75" text="edit"
                                        wire:click="$emit('openModal', 'team.team-modal', {{ json_encode(['id' => $team->team_id ?? $team->id]) }})" />
                                    <x-badge.error class="cursor-pointer w-16 hover:scale-105 transition-transform duration-200 delay-75" text="hapus"
                                        wire:click="deleteTeam({{ $team->team_id ?? $team->id }})" />
                                </div>
                            </x-slot>
                        </x-jet-dropdown>
                    </div>
                    <x-card.base class="flex flex-col justify-center space-y-4 md:space-y-8 text-center w-full max-w-xs cursor-pointer"
                        wire:click="openTeamDetail({{ $team->team_id ?? $team->id }})">
                        <p class="text-xl md:text-2xl text-{{ $team->color }} font-semibold underline underline-offset-8">{{ $team->name }}</p>
                        <i class="fa-solid fa-{{ $team->icon }} text-4xl md:text-7xl bg-{{ $team->color }} bg-clip-text text-transparent"></i>
                        <p>RO: {{ $team->ro }}</p>
                    </x-card.base>
                </div>
            @endforeach
        </div>
    @else
        <x-empty />
    @endif
</div>
