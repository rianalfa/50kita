@if ($row->hasRole('mitra'))
    <div class="grid place-items-center gap-2">
        <x-badge.success text='edit' class="cursor-pointer hover:scale-110 transition-all duration-300"
            wire:click="$emit('openModal', 'user.mitra-modal', {{ json_encode(['userId' => $row->id]) }})" />
        <x-badge.error text='hapus' class="cursor-pointer hover:scale-110 transition-all duration-500"
            wire:click="$emit('openModal', 'user.mitra-delete-modal', {{ json_encode(['userId' => $row->id]) }})" />
    </div>
@endif
