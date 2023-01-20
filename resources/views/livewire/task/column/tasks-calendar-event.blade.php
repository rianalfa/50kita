@php
    $taskProgress = \App\Models\Task::whereId($event['id'])->first()->progress ?? 0;
@endphp

<div class="cursor-pointer hover:scale-110 transition-all duration-200 delay-150 z-20"
    wire:click="$emit('openModal', 'task.tasks-calendar-event-modal', {{ json_encode(['taskId' => $event['id']]) }})">
    @if ($taskProgress < 50)
        <div class="shadow-sm rounded-lg
            {{ $taskProgress == 0 ? 'bg-white text-gray-800 shadow-gray-200' : 'bg-red-200 text-red-600 shadow-red-400' }}">
    @else
        <div class="shadow-sm rounded-lg
            {{ $taskProgress < 75 ? 'bg-yellow-200 text-yellow-600 shadow-yellow-400' : 'bg-green-200 text-green-600 shadow-green-400' }}">
    @endif
        <div class="flex flex-col justify-start space-y-1 px-2 py-1">
            <p class="font-bold">{{ $event['title'] }}</p>
            <p class="text-sm">{{ $event['description'] }}</p>
        </div>
    </div>
</div>
