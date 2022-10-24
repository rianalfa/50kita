<svg xmlns="http://www.w3.org/2000/svg"
    {{ $attributes->merge([
        'width' => '24',
        'height' => '24',
        'fill' => 'none',
        'stroke' => 'currentColor',
        'stroke-width' => '1.5',
        'viewBox' => '0 0 24 24',
        'stroke-linecap' => 'round',
        'stroke-linejoin' => 'round',
        'class' => ''
    ]) }}>
    {{ $slot }}
</svg>
