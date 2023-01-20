<div class="grid place-items-center gap-2">
    @php
        $user = \App\Models\UserTeam::where('team_id', $row->team_id)
                    ->where('position', 'Ketua')
                    ->first();
    @endphp
    @if (auth()->user()->id == $row->user_id)
        <x-badge.primary class="cursor-pointer hover:scale-105 transition-transform duration-200 delay-75" text="tambah progress"
            wire:click="$emit('openModal', 'task.report-modal', {{ json_encode(['taskId' => $row->id]) }})" />
    @endif

    @if (auth()->user()->id == $user->user_id)
        <x-badge.error class="cursor-pointer hover:scale-105 transition-transform duration-200 delay-75" text="hapus"
            wire:click="deleteTask({{ $row->id }})" />
    @endif
</div>
