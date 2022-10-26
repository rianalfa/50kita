@props(['menu' => 'Menu Item', 'active' => false, 'icon' => ''])

<li @class( [ 'text-blue-900 bg-white'=> $active,
    'text-white hover:bg-white/75 hover:text-blue-900' => !$active,
    'flex items-center rounded-xl cursor-pointer w-[95%] max-w-[13rem] mx-auto transition'
    ])>
    <a class="inline-flex space-x-4 items-center text-sm rounded-xl font-bold w-full px-4 py-2" {{ $attributes->merge(['href']) }}>
        <i class="fa-solid fa-{{ $icon }} text-xl"></i>
        <span class="ml-4 capitalize">{{ $menu }}</span>
    </a>
</li>
