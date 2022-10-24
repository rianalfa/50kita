<div class="bg-white shadow-sm flex-1 border border-gray-100 rounded text-gray-700">
    <div class="aspect-w-16 aspect-h-9 relative select-none">
        <img src="{{ $seminar->thumbnail_img }}" alt="{{ $seminar->title }}" class="rounded-t">
        <div
            class="absolute flex justify-center items-center bg-gray-800 bg-opacity-0 hover:bg-opacity-50 transition ease-in duration-100 group">
            @role(AppRoles::ADMIN)
                <div class="uppercase hidden group-hover:block font-bold">
                    <x-anchor.primary href="{{ route('admin.seminar.detail', $seminar->id) }}">
                        details
                    </x-anchor.primary>
                </div>
            @else
                <div class="uppercase hidden group-hover:block font-bold">
                    <x-anchor.primary href="{{ route('seminar.detail', $seminar->id) }}">
                        details
                    </x-anchor.primary>
                </div>
            @endrole
        </div>
    </div>
    <div class="p-4 group">
        <div class="flex">
            @role(AppRoles::ADMIN)
                <a href="{{ route('admin.seminar.detail', $seminar->id) }}"
                    class="flex-1 py-1 line-clamp-2 hover:text-gray-500 font-bold transition">
                    {{ $seminar->title }}
                </a>
                <div class="w-8">
                    <div class="hidden group-hover:block">
                        <x-jet-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button
                                    class="flex p-1 text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                    <x-icons.more-vertical width="20" height="20" />
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <x-jet-dropdown-link class="cursor-pointer"
                                    href="{{ route('admin.seminar.edit', $seminar->id) }}">
                                    {{ __('Edit') }}
                                </x-jet-dropdown-link>
                                <div class="border-t border-gray-100"></div>
                                <x-jet-dropdown-link class="cursor-pointer"
                                    onclick="Livewire.emit('openModal', 'seminar.delete-modal', {{ json_encode(['seminar_id' => $seminar->id]) }})">
                                    {{ __('Delete') }}
                                </x-jet-dropdown-link>
                            </x-slot>
                        </x-jet-dropdown>
                    </div>
                </div>
            @else
                <a href="{{ route('seminar.detail', $seminar->id) }}"
                    class="flex-1 py-1 line-clamp-2 hover:text-gray-500 font-bold transition">
                    {{ $seminar->title }}
                </a>
            @endrole
        </div>
        <div class="text-gray-600 text-sm">
            <div class="flex my-2 items-center">
                <x-icons.date class="w-5 h-5" />
                <div class="ml-2 pt-0.5">
                    {{ $seminar->date->format('d M Y, H:i') }}
                </div>
            </div>
            <div class="flex my-2 items-center">
                <x-icons.pencil class="w-5 h-5" />
                <div class="mx-2 pt-0.5">
                    {{ $seminar->open->format('d M Y, H:i') }}
                </div>
                @if ($seminar->open < now())
                    <x-badge.error text="Tutup" />
                @else
                    <x-badge.success text="Buka" />
                @endif
            </div>
        </div>
        <div class="text-gray-500 text-sm mt-2 select-none">
            @foreach ($seminar->category as $category)
                <span class="mr-2">#{{ $category }}</span>
            @endforeach
        </div>
    </div>
</div>
