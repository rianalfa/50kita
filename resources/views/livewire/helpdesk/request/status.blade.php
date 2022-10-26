<div class="flex flex-col justify-center items-center space-y-2 w-full h-full">
    @switch ($value)
        @case(1)
            <x-badge.error text="ditolak" class="mr-0" />
            <button class="text-sm font-semibold border-0 outline-0 hover:underline"
                wire:click="$emit('openModal', 'helpdesk.request.description-modal', {{ json_encode(['text' => $row->message]) }})">
                lihat pesan
            </button>
            @break
        @case(2)
            <x-badge.success text="diterima" class="mr-0" />
            <button class="text-sm font-semibold border-0 outline-0 hover:underline"
                wire:click="$emit('openModal', 'helpdesk.request.description-modal', {{ json_encode(['text' => $row->message]) }})">
                lihat pesan
            </button>
            @break
        @case(3)
            <x-badge.black text="selesai" class="mr-0" />
            @break
        @default
            <x-badge.warning text="menunggu" class="mr-0" />
    @endswitch
</div>
