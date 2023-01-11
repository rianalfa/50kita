@if ($row->hasRole('mitra'))
    <div class="grid place-items-center gap-2">
        <x-badge.success text='edit' class="cursor-pointer hover:scale-105 transition-transform duration-200 delay-75"
            wire:click="$emit('openModal', 'user.mitra-modal', {{ json_encode(['userId' => $row->id]) }})" />
        <x-badge.error text='hapus' class="cursor-pointer hover:scale-105 transition-transform duration-200 delay-75"
            wire:click="$emit('openModal', 'user.mitra-delete-modal', {{ json_encode(['userId' => $row->id]) }})" />
    </div>
@endif
