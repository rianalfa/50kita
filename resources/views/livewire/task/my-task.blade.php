<div class="flex flex-col relative space-y-8">
    <div class="flex justify-start">
        <x-input.toggle wire:model="tableCalendar" leftText="Tabel" text="Kalender" />
    </div>
    @if (!$tableCalendar)
        <livewire:task.my-tasks-table />
    @else
        <livewire:task.my-tasks-calendar
            before-calendar-view="livewire/task/calendar-month-buttons" />
    @endif
</div>
