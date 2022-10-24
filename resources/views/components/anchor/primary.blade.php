<a
    {{ $attributes->merge(['href' => '#', 'class' => 'bg-blue-500 hover:bg-blue-400 text-white active:bg-blue-400 focus:border-blue-400 focus:ring-blue-300 anchor-button']) }}>
    {{ $slot }}
</a>
