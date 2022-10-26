<div class="flex flex-col justify-center items-center space-y-2 w-full h-full">
    <x-badge.black text="lihat" class="cursor-pointer hover:bg-gray-500"
        wire:click="$emit('openModal', 'helpdesk.description-modal', {{ json_encode(['text' => $value]) }})" />

    <x-badge.white text="lampiran" class="cursor-pointer hover:bg-gray-200"
        wire:click="downloadAttachment({{ $row->id }})" />
</div>
