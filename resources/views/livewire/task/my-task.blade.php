<div class="flex flex-col relative space-y-8">
    <div class="flex justify-start">
        <x-input.toggle wire:model="tableCalendar" leftText="Tabel" text="Kalender" />
    </div>
    @if (!$tableCalendar)
        <livewire:team.team-tasks-table teamId="" userId="{{ auth()->user()->id }}" />
    @else
        <livewire:team.team-tasks-calendar teamId="" userId="{{ auth()->user()->id }}"
            before-calendar-view="livewire/task/calendar-month-buttons" />
    @endif
</div>
