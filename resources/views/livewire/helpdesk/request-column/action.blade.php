<div class="flex flex-col justify-center items-center space-y-2 w-full h-full">
    @if (auth()->user()->hasRole('ipds'))
        @if ($row->status == 0)
            <x-badge.success text="terima" class="cursor-pointer hover:bg-green-500 hover:text-white" wire:click="acceptRequest({{ $row->id }})" />
            <x-badge.error text="tolak" class="cursor-pointer hover:bg-red-500 hover:text-white" wire:click="rejectRequest({{ $row->id }})" />
        @endif
    @else
        <x-badge.success text="edit" class="cursor-pointer hover:bg-green-500 hover:text-white" wire:click="editRequest({{ $row->id }})" />
        <x-badge.error text="hapus" class="cursor-pointer hover:bg-red-500 hover:text-white" wire:click="deleteRequest({{ $row->id }})" />
    @endif
</div>
