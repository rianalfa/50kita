@props(['menu' => 'Menu Item', 'active' => false, 'icon' => ''])

<li @class( [ 'text-blue-900 bg-white'=> $active,
    'text-white hover:bg-gray-500/75' => !$active,
    'flex items-center rounded-xl cursor-pointer w-[95%] max-w-[13rem] mx-auto transition'
    ])>
    <a class="inline-flex space-x-4 items-center {{ $active ? 'bg-blue-600/50' : '' }} text-sm rounded-xl font-bold w-full px-4 py-2" {{ $attributes->merge(['href']) }}>
        <i class="fa-solid fa-{{ $icon }} text-xl text-white"></i>
        <span class="ml-4 capitalize">{{ $menu }}</span>
    </a>
</li>
