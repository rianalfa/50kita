<div class="flex flex-col justify-center space-y-2">
    @role('ipds')
        <x-badge.success class="cursor-pointer w-24 hover:scale-105 transition-transform duration-200 delay-75" text="jadikan ketua"
            wire:click="makeChief({{ $row->user_id }})" />
    @endrole

    @php
        $user = \App\Models\UserTeam::where('user_id', auth()->user()->id)
                    ->where('team_id', $this->teamId)
                    ->first() ?? [];
    @endphp
    @if (auth()->user()->hasRole('ipds') || (!empty($user) && $user->position=='Ketua'))
        <x-badge.primary class="cursor-pointer w-24 hover:scale-105 transition-transform duration-200 delay-75" text="beri pekerjaan"
            wire:click="$emit('openModal', 'task.task-modal', {{ json_encode([
                'teamId' => $row->team_id,
                'userId' => $row->user_id,
            ]) }})" />

        @if ($row->position != 'Ketua')
            <x-badge.error class="cursor-pointer w-24 hover:scale-105 transition-transform duration-200 delay-75" text="hapus"
                wire:click="deleteMember({{ $row->user_id }})" />
        @endif
    @endif
</div>
