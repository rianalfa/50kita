@props([
    'model' => '',
    'label' => 'File'
])

<div
    x-data="{ isUploading: false, progress: 0 }"
    x-on:livewire-upload-start="isUploading = true"
    x-on:livewire-upload-finish="isUploading = false"
    x-on:livewire-upload-error="isUploading = false"
    x-on:livewire-upload-progress="progress = $event.detail.progress"
>
    <x-input.wrapper>
        <x-input.label for="{{ $model }}" value="{{ $label }}" />
        <x-input.text type="file" id="{{ $model }}" name="{{ $model }}" wire:model="{{ $model }}"
            {{ $attributes->merge(['class' => '']) }} />
        <x-input.error for="{{ $model }}" />
    </x-input.wrapper>

    <div x-show="isUploading">
        <div class="bg-gray-300 rounded-full w-1/2 h-4 mx-auto">
            <div class="bg-blue-600 rounded-full h-4" :style="`width: ${progress}%;`"></div>
        </div>
    </div>
</div>
