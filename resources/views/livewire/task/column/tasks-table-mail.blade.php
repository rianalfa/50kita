<div class="grid place-items-center gap-2">
    @php
        $mail = \App\Models\TaskMail::where('task_id', $row->id)->first() ?? new \App\Models\TaskMail();

        $chiefId = \App\Models\UserTeam::where('team_id', $row->team_id)
                        ->where('position', 'Ketua')
                        ->first()->user_id ?? 0;
    @endphp

    @if ($mail->status == 0)
        @if (auth()->user()->id == $row->user_id || auth()->user()->id == $chiefId || auth()->user()->hasRole('admin'))
            <x-badge.white text="unduh surat" class="cursor-pointer hover:scale-105 transition-transform duration-200 delay-75"
                wire:click="downloadMail({{ $row->id }})" />
            <x-badge.black text="unggah surat" class="cursor-pointer hover:scale-105 transition-transform duration-200 delay-75"
                wire:click="$emit('openModal', 'task.task-mail-upload-modal', {{ json_encode(['taskId' => $row->id]) }})" />
        @else
            <x-badge.error text="surat belum diunggah" />
        @endif
    @elseif ($mail->status == 1)
        @if (auth()->user()->hasRole('finance'))
            <x-badge.success text="terima surat" class="cursor-pointer hover:scale-105 transition-transform duration-200 delay-75"
                wire:click="acceptMail({{ $row->id }})" />
            <a href="{{ asset('storage/mails/uploaded/'.$row->start_from.'_'.$row->mail->number.'.docx') }}">
                <x-badge.white text="lihat surat" class="cursor-pointer hover:scale-105 transition-transform duration-200 delay-75"
                    />
            </a>
        @else
            <x-badge.error text="surat belum diterima" />
        @endif
    @elseif ($mail->status == 2)
        @if (auth()->user()->hasRole('finance'))
            <x-badge.success text="bayar" class="cursor-pointer hover:scale-105 transition-transform duration-200 delay-75"
                wire:click="$emit('openModal', 'task.payment-modal', {{ json_encode(['taskId' => $row->id]) }})" />
        @else
            <x-badge.warning text="belum dibayar" />
        @endif
    @elseif ($mail->status == 3)
        <x-badge.success text="sudah dibayar" />
        <x-badge.white text="unduh kwitansi" class="cursor-pointer hover:scale-105 transition-transform duration-200 delay-75"
            wire:click="downloadReceipt({{ $row->id }})" />
    @endif
</div>
