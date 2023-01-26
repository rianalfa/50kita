<div>
    <x-modal.header title="Tugas"></x-modal.header>
    <x-modal.body>
        <x-input.wrapper>
            <x-input.label for="task.team_id" value="Tim" />
            <x-input.select name="team_id" wire:model="task.team_id" wire:change="changeTeam">
                @foreach (\App\Models\Team::get() as $team)
                    <option value="{{ $team->id }}">{{ $team->name }}</option>
                @endforeach
            </x-input.select>
            <x-input.error for="task.team_id" />
        </x-input.wrapper>

        <x-input.wrapper>
            <x-input.label for="task.user_id" value="Pelaksana" />
            <x-input.select name="user_id" wire:model.defer="task.user_id">
                @foreach (\App\Models\UserTeam::where('team_id', $task->team_id)->get() as $user)
                    <option value="{{ $user->user_id }}">{{ $user->user->name }}</option>
                @endforeach
            </x-input.select>
            <x-input.error for="task.user_id" />
        </x-input.wrapper>

        <x-input.wrapper>
            <x-input.label for="task.title" value="Tugas" />
            <x-input.select name="title" wire:model.defer="task.title">
                @foreach (\App\Models\TaskType::get() ?? [] as $type)
                    <option value="{{ $type->title }}">{{ $type->title }}</option>
                @endforeach
            </x-input.select>
            <x-input.error for="task.title" />
        </x-input.wrapper>

        <x-input.wrapper>
            <x-input.label for="taskMail.place" value="Tempat" />
            <x-input.text name="place" wire:model.defer="taskMail.place" />
            <x-input.error for="taskMail.place" />
        </x-input.wrapper>

        <x-input.wrapper>
            <x-input.label for="task.start_from" value="Tanggal Mulai" />
            <x-input.text type="date" name="start_from" wire:model.defer="task.start_from" />
            <x-input.error for="task.start_from" />
        </x-input.wrapper>

        <x-input.wrapper>
            <x-input.label for="task.due_date" value="Tanggal Selesai" />
            <x-input.text type="date" name="due_date" wire:model.defer="task.due_date" />
            <x-input.error for="task.due_date" />
        </x-input.wrapper>

        <x-input.wrapper>
            <x-input.label for="taskMail.user_id" value="TTD" />
            <x-input.select name="user_id" wire:model.defer="taskMail.user_id">
                @foreach ($users as $user)
                    @php
                        if (!$user->hasRole('admin')) continue;
                    @endphp

                    <option value="{{ $user->id }}">{{ explode(',', $user->name)[0] }}</option>
                @endforeach
            </x-input.select>
            <x-input.error for="taskMail.user_id" />
        </x-input.wrapper>

        <x-input.wrapper>
            <x-input.label for="task.description" value="Deskripsi" />
            <x-input.text name="description" wire:model.defer="task.description" />
            <x-input.error for="task.description" />
        </x-input.wrapper>

        <x-input.wrapper>
            <x-input.toggle text="SPD" wire:model="taskMail.spd" />
            <x-input.error for="taskMail.spd" />
        </x-input.wrapper>
    </x-modal.body>
    <x-modal.footer bordered>
        <x-button.primary wire:click="saveTask()">Simpan</x-button.primary>
    </x-modal.footer>
</div>
