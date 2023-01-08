<div class="flex flex-col justify-center items-center space-y-2 w-full h-full">
    @if (auth()->user()->hasRole('admin'))
        @if (in_array($row->status, [0,1]))
            <x-badge.success text="terima" class="cursor-pointer hover:bg-green-500 hover:text-white" wire:click="acceptInterference({{ $row->id }})" />
            <x-badge.error text="tolak" class="cursor-pointer hover:bg-red-500 hover:text-white" wire:click="rejectInterference({{ $row->id }})" />
        @elseif ($row->status == 2)
            <x-badge.black text="selesai" class="cursor-pointer hover:bg-gray-500" wire:click="finishInterference({{ $row->id }})" />
        @endif
    @else
        @if (in_array($row->status, [2,3]))
            <x-badge.success text="edit" class="cursor-pointer hover:bg-green-500 hover:text-white" wire:click="editInterference({{ $row->id }})" />
            <x-badge.error text="hapus" class="cursor-pointer hover:bg-red-500 hover:text-white" wire:click="deleteInterference({{ $row->id }})" />
        @endif
    @endif
</div>
