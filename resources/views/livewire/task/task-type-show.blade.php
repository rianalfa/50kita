<div class="w-full">
    <x-card.base>
        <div class="flex flex-col lg:flex-row space-y-4 lg:space-y-0">
            <p class="text-xl font-bold text-left">Jenis Tugas</p>
            <x-button.primary class="ml-auto" wire:click="$emit('openModal', 'task.task-type-modal')"
                >+ Jenis Tugas
            </x-button.primary>
        </div>
        <div class="flex flex-col space-y-4 h-80 max-h-80 mt-4 lg:mt-8 overflow-y-auto">
            @forelse ($taskTypes as $type)
                <x-button.white wire:click="$emit('openModal', 'task.task-type-modal', {{ json_encode(['id' => $type->id]) }})">{{ $type->title }}</x-button.white>
            @empty
                <p class="text-gray-500 text-center my-auto">Tidak ada jenis tugas yang ditamplikan</p>
            @endforelse
        </div>
    </x-card.base>
</div>
