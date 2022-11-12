<div>
    <x-modal.header title="Tambah Anggota"></x-modal.header>
    <x-modal.body>
        <x-input.wrapper>
            <x-input.label for="userTeam.user_id" value="Nama" />
            <x-input.select name="member" wire:model.defer="userTeam.user_id">
                @foreach ($users as $user)
                    @php
                        $checkUserTeam = \App\Models\UserTeam::where('team_id', $teamId)
                                                ->where('user_id', $user->id)
                                                ->first() ?? []
                    @endphp
                    @if (empty($checkUserTeam))
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endif
                @endforeach
            </x-input.select>
            <x-input.error for="userTeam.user_id" />
        </x-input.wrapper>
    </x-modal.body>
    <x-modal.footer bordered>
        <x-button.primary wire:click="saveNewMember()">
            Tambah Anggota
        </x-button.primary>
    </x-modal.footer>
</div>
