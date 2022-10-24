@props(['result'])

<div class="bg-white shadow-md flex-1 border overflow-hidden border-gray-100 rounded-sm text-gray-700">
    <div class="p-3 flex">
        <div class="w-full mx-0 mr-2 md:mx-2 md:mr-0">
            <div class="flex justify-between items-center">
                <div class="mt-1">
                    <a href="{{ route('test.detail', $result->test_id) }}"
                        class="text-base font-bold text-gray-600 hover:text-blue-400 transition duration-150">
                        {{ $result->test->name }}
                    </a>
                </div>
            </div>
            <div class="text-gray-600 text-sm mb-4">
                <div class="flex my-2 items-center">
                    <x-icons.time class="w-5 h-5" />
                    <div class="ml-2 pt-0.5">
                        Mulai {{ $result->created_at->format('d M Y, H:i') }}
                    </div>
                </div>
                <div class="flex my-2 items-center">
                    <x-icons.time class="w-5 h-5" />
                    <div class="ml-2 pt-0.5">
                        Selesai {{ $result->completed_at->format('d M Y, H:i') }}
                    </div>
                </div>
            </div>
            <div class="flex">
                <x-anchor.primary href="{{ route('test.result.detail', $result->id)  }}">
                    Detail
                </x-anchor.primary>
            </div>
        </div>
    </div>
</div>
