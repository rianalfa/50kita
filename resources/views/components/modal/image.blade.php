<div>
    <x-modal.header title="Image Preview" />
    <x-modal.body>
        <img src="{{ Storage::disk('public')->url($img) }}" alt="{{ $img }}">
    </x-modal.body>
    <x-modal.footer bordered>
        <div class="ml-2">
            <x-button.secondary wire:click="$emit('closeModal')">
                Close
            </x-button.secondary>
        </div>
    </x-modal.footer>
</div>
