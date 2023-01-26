<div>
    <x-modal.header title="Tugas {{ $task->title }}" />
    <x-modal.body>
        @php
            $chiefId = \App\Models\UserTeam::where('team_id', $task->team_id)
                            ->where('position', 'Ketua')
                            ->first()->user_id ?? 0;
        @endphp

        <div class="grid grid-cols-1 lg:grid-cols-6 gap-2">
            <p>Tim:</p>
            <div class="flex justify-end items-center col-span-1 lg:col-span-5">
                <p>{{ $task->team->name }}</p>
            </div>

            @if ($task->user_id != auth()->user()->id)
                <p>Pelaksana:</p>
                <div class="flex justify-end items-center col-span-1 lg:col-span-5">
                    <p>{{ $task->user->name }}</p>
                </div>
            @endif

            <p>Tugas:</p>
            <div class="flex justify-end items-center col-span-1 lg:col-span-5">
                <p>{{ $task->title }}</p>
            </div>

            <p>Tanggal Mulai:</p>
            <div class="flex justify-end items-center col-span-1 lg:col-span-5">
                <p>{{ $task->start_from }}</p>
            </div>

            <p>Tanggal Selesai:</p>
            <div class="flex justify-end items-center col-span-1 lg:col-span-5">
                <p>{{ $task->due_date }}</p>
            </div>

            <p>Progress:</p>
            <div class="flex justify-end items-center col-span-1 lg:col-span-5">
                @if ($task->progress >= 75)
                    <x-badge.success class="w-16" text="{{ $task->progress }}%" />
                @elseif ($task->progress >= 50)
                    <x-badge.warning class="w-16" text="{{ $task->progress }}%" />
                @elseif ($task->progress > 0)
                    <x-badge.error class="w-16" text="{{ $task->progress }}%" />
                @else
                    <x-badge.white class="w-16" text="{{ $task->progress }}%" />
                @endif
            </div>

            <p>Surat Tugas:</p>
            <div class="flex justify-end items-center col-span-1 lg:col-span-5">
                <div class="flex flex-col space-y-2">
                    @if ($task->mail->status == 0)
                        @if (auth()->user()->id == $task->user_id || auth()->user()->hasRole('admin') || auth()->user()->id == $chiefId)
                            <x-badge.white text="unduh surat" class="cursor-pointer hover:scale-105 transition-transform duration-200 delay-75"
                                wire:click="downloadMail({{ $task->id }})" />
                            <x-badge.black text="unggah surat" class="cursor-pointer hover:scale-105 transition-transform duration-200 delay-75"
                                wire:click="$emit('openModal', 'task.task-mail-upload-modal', {{ json_encode(['taskId' => $task->id]) }})" />
                        @else
                            <x-badge.error text="surat belum diunggah" />
                        @endif
                    @elseif ($task->mail->status == 1)
                        @if (auth()->user()->hasRole('finance'))
                            <x-badge.success text="terima surat" class="cursor-pointer hover:scale-105 transition-transform duration-200 delay-75"
                                wire:click="acceptMail({{ $task->id }})" />
                            <a href="{{ asset('storage/mails/uploaded/'.$task->start_from.'_'.$task->mail->number.'.docx') }}">
                                <x-badge.white text="lihat surat" class="cursor-pointer hover:scale-105 transition-transform duration-200 delay-75"
                                    />
                            </a>
                        @else
                            <x-badge.error text="surat belum diterima" />
                        @endif
                    @elseif ($task->mail->status == 2)
                        @if (auth()->user()->hasRole('finance'))
                            <x-badge.success text="bayar" class="cursor-pointer hover:scale-105 transition-transform duration-200 delay-75"
                                wire:click="$emit('openModal', 'task.payment-modal', {{ json_encode(['taskId' => $task->id]) }})" />
                        @else
                            <x-badge.warning text="belum dibayar" />
                        @endif
                    @elseif ($task->mail->status == 3)
                        <x-badge.success text="sudah dibayar" />
                        <x-badge.white text="unduh kwitansi" class="cursor-pointer hover:scale-105 transition-transform duration-200 delay-75"
                            wire:click="downloadReceipt({{ $task->id }})" />
                    @endif
                </div>
            </div>
        </div>
    </x-modal.body>

    @if ($task->user_id == auth()->user()->id || auth()->user()->hasRole('admin') || auth()->user()->id == $chiefId)
        <x-modal.footer bordered>
            <div class="flex justify-center align-center space-x-4">
                @if ($this->task->progress == 0 || auth()->user()->hasRole('admin') || auth()->user()->id == $chiefId)
                    <x-button.error wire:click="deleteTask">Hapus</x-button.error>
                @endif

                <x-button.primary wire:click="$emit('openModal', 'task.report-modal', {{ json_encode(['taskId' => $task->id]) }})">
                    Tambah Progress
                </x-button.primary>
            </div>
        </x-modal.footer>
    @endif
</div>
