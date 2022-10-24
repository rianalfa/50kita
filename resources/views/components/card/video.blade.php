<div class="bg-white shadow-sm flex-1 border border-gray-100 rounded-sm text-gray-700">
    <div class="aspect-w-16 aspect-h-9 relative select-none">
        <img class="bg-cover" src="{{ $video->thumbnail_img }}" alt="{{ $video->thumbnail_img }}">
        @if ($video->premium)
            <div class="absolute top-2 left-2">
                <x-badge.primary text="premium" class="uppercase select-none" />
            </div>
        @endif
        <div
            class="absolute flex justify-center items-center bg-gray-800 bg-opacity-0 hover:bg-opacity-50 transition ease-in duration-100 group">
            @if ($video->premium)
                @hasanyrole(AppRoles::PREMIUM_USERS . '|' . AppRoles::ADMIN)
                    <div class="uppercase hidden group-hover:block font-bold">
                        <x-anchor.primary href="{{ route('videos.detail', $video->id) }}">
                            watch
                        </x-anchor.primary>
                    </div>
                @else
                    <div class="uppercase hidden group-hover:block font-bold cursor-pointer">
                        <x-button.primary onclick="Livewire.emit('openModal', 'promotions.modal-premium-users')">
                            UPGRADE TO PREMIUM
                        </x-button.primary>

                    </div>
                @endhasanyrole
            @else
                <div class="uppercase hidden group-hover:block font-bold">
                    <x-anchor.primary href="{{ route('videos.detail', $video->id) }}">
                        watch
                    </x-anchor.primary>
                </div>
            @endif
        </div>
    </div>
    <div class="p-4 group">
        <div class="flex">
            @if ($video->premium)
                @hasanyrole(AppRoles::PREMIUM_USERS . '|' . AppRoles::ADMIN)
                    <a href="{{ route('videos.detail', $video->id) }}"
                        class="flex-1 py-1 line-clamp-2 hover:text-gray-500 transition">
                        {{ $video->title }}
                    </a>
                @else
                    <div onclick="Livewire.emit('openModal', 'promotions.modal-premium-users')"
                        class="flex-1 py-1 line-clamp-2 hover:text-gray-500 transition">
                        {{ $video->title }}
                    </div>
                @endhasanyrole
            @else
                <a href="{{ route('videos.detail', $video->id) }}"
                    class="flex-1 py-1 line-clamp-2 hover:text-gray-500 transition">
                    {{ $video->title }}
                </a>
            @endif

            @role(AppRoles::ADMIN)
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
                                <x-jet-dropdown-link class="cursor-pointer" href="{{ route('admin.videos.edit', $video->id) }}">
                                    {{ __('Edit') }}
                                </x-jet-dropdown-link>
                                <div class="border-t border-gray-100"></div>
                                <x-jet-dropdown-link class="cursor-pointer"
                                    onclick="Livewire.emit('openModal', 'videos.delete-modal', {{ json_encode(['video_id' => $video->id]) }})">
                                    {{ __('Delete') }}
                                </x-jet-dropdown-link>
                            </x-slot>
                        </x-jet-dropdown>
                    </div>
                </div>
            @endrole
        </div>
        <div class="text-gray-500 text-sm mt-2 select-none">
            @foreach ($video->category as $category)
                <span class="mr-2">#{{ $category }}</span>
            @endforeach
        </div>
    </div>
</div>
