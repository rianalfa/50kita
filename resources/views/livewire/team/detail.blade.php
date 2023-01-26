<div class="flex flex-col relative space-y-4 md:space-y-12">
    <div class="flex flex-col space-y-4 bg-white rounded-xl px-4 py-8">
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
    </div>

    <div class="flex flex-col justify-center space-y-4 bg-white rounded-xl p-4">
        <div class="flex justify-between items-center">
            <p class="text-base md:text-lg font-semibold">Anggota</p>
            @if (auth()->user()->hasRole('admin') || $chief->id==auth()->user()->id)
                <x-button.primary wire:click="$emit('openModal', 'team.member-modal', {{ json_encode(['teamId' => $team->id]) }})">
                    + Anggota
                </x-button.primary>
            @endif
        </div>
        <livewire:team.members-table id="{{ $team->id }}" />
    </div>

    @if (!empty(\App\Models\UserTeam::where('user_id', auth()->user()->id)->where('team_id', $team->id)->first() ?? []) || auth()->user()->hasRole('admin'))
        <div class="flex flex-col justify-center space-y-4 bg-white rounded-xl p-4">
            <p class="text-base md:text-lg font-semibold">Tugas Tim</p>
            <div class="flex justify-between my-4">
                <x-input.toggle text="Kalender" leftText="Tabel" wire:model="tableCalendar" />
                <x-input.toggle text="Tugas Saya" wire:model="myTasks" />
            </div>
            @if ($tableCalendar)
                @if ($myTasks)
                    <livewire:task.tasks-calendar teamId="{{ $team->id }}" userId="{{ auth()->user()->id }}"
                        before-calendar-view="livewire/task/calendar-month-buttons" />
                @else
                    <livewire:task.tasks-calendar teamId="{{ $team->id }}" userId=""
                        before-calendar-view="livewire/task/calendar-month-buttons" />
                @endif
            @else
                @if ($myTasks)
                    <livewire:task.tasks-table teamId="{{ $team->id }}" userId="{{ auth()->user()->id }}" />
                @else
                    <livewire:task.tasks-table teamId="{{ $team->id }}" />
                @endif
            @endif
        </div>
    @endif
</div>
