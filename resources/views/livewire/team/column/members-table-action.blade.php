<div class="grid place-items-center gap-2">
    @role('admin')
        <x-badge.success class="cursor-pointer hover:scale-105 transition-transform duration-200 delay-75" text="jadikan ketua"
            wire:click="makeChief({{ $row->user_id }})" />
    @endrole

    @php
        $user = \App\Models\UserTeam::where('user_id', auth()->user()->id)
                    ->where('team_id', $this->teamId)
                    ->first() ?? [];
    @endphp
    @if (auth()->user()->hasRole('admin') || (!empty($user) && $user->position=='Ketua'))
        <x-badge.primary class="cursor-pointer hover:scale-105 transition-transform duration-200 delay-75" text="beri tugas"
            wire:click="$emit('openModal', 'task.task-modal', {{ json_encode([
                'teamId' => $row->team_id,
                'userId' => $row->user_id,
            ]) }})" />

        @if ($row->position != 'Ketua')
            <x-badge.error class="cursor-pointer hover:scale-105 transition-transform duration-200 delay-75" text="hapus"
                wire:click="deleteMember({{ $row->user_id }})" />
        @endif
    @endif
</div>
