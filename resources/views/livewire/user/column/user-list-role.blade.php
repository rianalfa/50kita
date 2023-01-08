<div class="grid place-items-center">
    @if (auth()->user()->hasRole('admin') && $row->name != 'superadmin')
        <div class="cursor-pointer hover:scale-110 transition-all duration-300"
            wire:click="$emit('openModal', 'user.user-role-modal', {{ json_encode(['userId' => $row->id]) }})">
    @else
        <div>
    @endif
        @if ($row->hasRole("admin"))
            <x-badge.primary text="Admin" />
        @elseif ($row->hasRole("user"))
            <x-badge.success text="Organik" />
        @else
            <x-badge.error text="Mitra" />
        @endif
    </div>
</div>
