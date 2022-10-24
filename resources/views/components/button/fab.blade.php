<button
    {{ $attributes->merge([
    'type' => 'button',
    'class' => 'bg-green-500 hover:bg-green-400 text-white active:bg-green-400 focus:border-green-400 focus:ring-green-300 rounded-full w-12 h-12 p-2 absolute right-4 bottom-4 flex items-center justify-center shadow-lg z-30',
]) }}>
    {{ $slot }}
</button>
