<div class="flex justify-center items-center w-full h-full">
    @switch ($value)
        @case(1)
            <x-badge.error text="ditolak" />
            @break
        @case(2)
            <x-badge.success text="disetujui" />
            @break
        @default
            <x-badge.warning text="menunggu" />
    @endswitch
</div>
