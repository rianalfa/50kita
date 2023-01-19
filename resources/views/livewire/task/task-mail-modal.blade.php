<div>
    <x-modal.header title="Surat Tugas" />
    <x-modal.body>
        <x-input.wrapper>
            <x-input.toggle text="SPD" wire:model="taskMail.spd" />
            <x-input.error for="taskMail.spd" />
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
            <x-input.label for="taskMail.place" value="Tempat" />
            <x-input.text name="place" wire:model.defer="taskMail.place" />
            <x-input.error for="taskMail.place" />
        </x-input.wrapper>

        <x-input.wrapper>
            <x-input.label for="taskMail.note" value="Catatan" />
            <x-input.textarea name="note" wire:model.defer="taskMail.note" />
            <x-input.error for="taskMail.note" />
        </x-input.wrapper>
    </x-modal.body>
    <x-modal.footer class="flex-end" bordered>
        <x-button.primary wire:click="saveTaskMail">Simpan</x-button.primary>
    </x-modal.footer>
</div>
