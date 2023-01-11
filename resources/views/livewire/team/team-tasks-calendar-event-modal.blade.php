<div>
    <x-modal.header title="Tugas {{ $task->title }}" />
    <x-modal.body>
        <div class="flex justify-center align-center space-x-4">
            <x-button.error wire:click="deleteTask">Hapus</x-button.error>
            <x-button.primary wire:click="$emit('openModal', 'task.report-modal', {{ json_encode(['taskId' => $task->id]) }})">
                Tambah Progress
            </x-button.primary>
        </div>
    </x-modal.body>
</div>
