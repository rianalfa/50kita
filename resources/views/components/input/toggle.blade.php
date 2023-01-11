@props([
    'checked' => false,
    'text' => "",
    'leftText' => "",
])

<label class="inline-flex relative items-center cursor-default">
    @isset($leftText)
        <span class="mr-2 text-sm text-gray-700 font-semibold capitalize">{{ $leftText }}</span>
    @endisset
    <div class="inline-flex relative items-center cursor-pointer">
        <input type="checkbox" value="" class="sr-only peer" {{ $checked ? 'checked' : '' }}
            {{ $attributes->merge(['wire:model' => "", 'wire:model.defer' => "", 'wire:change' => ""])}}
        />
        <div {{ $attributes->merge(['class' => "w-10 h-5 bg-gray-200 rounded-full peer peer-focus:ring-2 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-gray-300 after:content-[''] after:absolute after:top-0 after:left-[1px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"]) }}></div>
    </div>
    @isset($text)
        <span class="ml-2 text-sm text-gray-700 font-semibold capitalize">{{ $text }}</span>
    @endisset
</label>
