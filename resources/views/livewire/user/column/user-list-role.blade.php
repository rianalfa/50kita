<div class="grid place-items-center">
    @if (auth()->user()->hasRole('superadmin') && !$row->hasRole('superadmin') && !$row->hasRole('mitra'))
        <div class="flex flex-col space-y-2 cursor-pointer hover:scale-110 transition-all duration-300"
            wire:click="$emit('openModal', 'user.user-role-modal', {{ json_encode(['userId' => $row->id]) }})">
    @else
        <div class="flex flex-col space-y-2">
    @endif
        @foreach ($row->getRoleNames() as $roleName)
            @php
                if ($roleName == 'superadmin') continue;
            @endphp

            @if ($roleName == "finance")
                <x-badge.white text="Bendahara" />
            @elseif ($roleName == "ppk")
                <x-badge.black text="PPK" />
            @elseif ($roleName == "admin")
                <x-badge.primary text="Admin" />
            @elseif ($roleName == "user")
                <x-badge.success text="Organik" />
            @else
                <x-badge.error text="Mitra" />
            @endif
        @endforeach
    </div>
</div>
