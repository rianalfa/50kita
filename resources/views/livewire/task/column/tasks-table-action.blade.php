<div class="grid place-items-center gap-2">
    @php
        $chiefId = \App\Models\UserTeam::where('team_id', $row->team_id)
                        ->where('position', 'Ketua')
                        ->first()->user_id ?? 0;
    @endphp

    @if (auth()->user()->id == $row->user_id || auth()->user()->hasRole('admin'))
        <x-badge.primary class="cursor-pointer hover:scale-105 transition-transform duration-200 delay-75" text="tambah progress"
            wire:click="$emit('openModal', 'task.report-modal', {{ json_encode(['taskId' => $row->id]) }})" />
    @endif

    @if (auth()->user()->id == $chiefId || auth()->user()->hasRole('admin'))
        <x-badge.error class="cursor-pointer hover:scale-105 transition-transform duration-200 delay-75" text="hapus"
            wire:click="deleteTask({{ $row->id }})" />
    @endif
</div>
