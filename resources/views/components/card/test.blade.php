<div class="bg-white shadow-md flex-1 border border-gray-100 rounded-sm text-gray-700">
    <div class="p-3 flex">
        <div class="w-full mx-0 mr-2 md:mx-2 md:mr-0">
            <div class="flex justify-between items-center">
                <div class="mt-1">
                    <a href="{{ route('test.detail', $test->id) }}"
                        class="text-base font-bold text-gray-600 hover:text-blue-400 transition duration-150">
                        {{ $test->name }}
                    </a>
                    @role(AppRoles::ADMIN)
                        <span class="whitespace-nowrap select-none my-2">
                            @if ($test->is_published)
                                <x-badge.success text="Publish" />
                            @else
                                <x-badge.error text="Belum Publish" />
                            @endif
                        </span>
                    @endrole
                </div>
            </div>
            <div class="my-2 pb-2 text-sm font-normal text-gray-500">
                {!! Str::of($test->description)->limit(200, '...')->markdown() !!}
            </div>
            <div class="flex">
                <x-anchor.primary href="{{ route('test.detail', $test->id) }}">
                    MASUK
                </x-anchor.primary>
            </div>
        </div>
    </div>
</div>
