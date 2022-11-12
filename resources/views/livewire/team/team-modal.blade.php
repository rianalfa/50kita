<div>
    <x-modal.header title="{{ empty($team->id) ? 'Tambah Tim' : 'Edit Team' }}"></x-modal.header>
    <x-modal.body>
        <x-input.wrapper>
            <x-input.label for='team.name' value="Nama Tim" />
            <x-input.text name='name' wire:model.defer='team.name' />
            <x-input.error for='team.name' />
        </x-input.wrapper>

        <x-input.wrapper>
            <x-input.label for='team.ro' value="RO Tim" />
            <x-input.text name='ro' wire:model.defer='team.ro' />
            <x-input.error for='team.ro' />
        </x-input.wrapper>

        <x-input.wrapper>
            <x-input.label for='team.icon' value="Ikon Tim" />
            <x-jet-dropdown>
                <x-slot name="trigger">
                    <div class="flex justify-between items-center bg-white border border-gray-300 rounded-md shadow-sm cursor-pointer py-2 px-4 hover:bg-blue-100">
                        <p class='text-gray-700 text-sm font-medium'>Pilih Ikon</p>
                        @if (empty($team->icon))
                            <i class="fa-solid fa-chevron-down"></i>
                        @else
                            <i class='fa-solid fa-{{ $team->icon }} text-center'></i>
                        @endif
                    </div>
                </x-slot>

                <x-slot name="content">
                    <div class="flex flex-col space-y-4 w-full h-32 py-2 px-4 z-50 overflow-y-auto">
                        @foreach (TeamIconColorConstant::icons() as $icon)
                            <x-button.white class='py-0' wire:click="changeIcon('{{ $icon }}')">
                                <i class='fa-solid fa-{{ $icon }} text-xl text-center mx-auto'></i>
                            </x-button.white>
                        @endforeach
                    </div>
                </x-slot>
            </x-jet-dropdown>
            <x-input.error for='team.icon' />
        </x-input.wrapper>

        <x-input.wrapper>
            <x-input.label for='team.color' value="Warna Tim" />
            <x-jet-dropdown>
                <x-slot name="trigger">
                    <div class="flex justify-between items-center bg-white border border-gray-300 rounded-md shadow-sm cursor-pointer py-2 px-4 hover:bg-blue-100">
                        <p class='text-gray-700 text-sm font-medium'>Pilih Warna</p>
                        @if (empty($team->color))
                            <i class="fa-solid fa-chevron-down"></i>
                        @else
                            <div class="bg-{{ $team->color }} w-12 h-4 rounded-sm"></div>
                        @endif
                    </div>
                </x-slot>

                <x-slot name="content">
                    <div class="flex flex-col space-y-4 w-full h-32 py-2 px-4 z-50 overflow-y-auto">
                        @foreach (TeamIconColorConstant::colors() as $color)
                            <x-button.white class='py-0 px-0' wire:click="changeColor('{{ $color }}')">
                                <div class="bg-{{ $color }} w-full h-4 rounded-sm hover:opacity-75"></div>
                            </x-button.white>
                        @endforeach
                    </div>
                </x-slot>
            </x-jet-dropdown>
            <x-input.error for='team.color' />
        </x-input.wrapper>

        <x-input.wrapper>
            <x-input.label for='team.description' value='Deskripsi Tim' />
            <x-input.textarea name='description' wire:model.defer='team.description'></x-input.textarea>
            <x-input.error for='team.description' />
        </x-input.wrapper>
    </x-modal.body>
    <x-modal.footer bordered>
        <x-button.primary wire:click="saveTeam()">Simpan</x-button.primary>
    </x-modal.footer>
</div>
