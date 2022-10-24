@props(['disabled' => false])

<div class="relative" x-data="{ show: true }">
    <input {{ $disabled ? 'disabled' : '' }} :type="show ? 'password' : 'text'" {!! $attributes->merge(['class' => 'mt-1 mr-4 block w-full border-gray-300 focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 rounded-md shadow-sm disabled:opacity-50']) !!} />
    <div class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5 cursor-pointer">
        <div @click="show = !show" x-show="show">
            <x-icons.eye-open />
        </div>
        <div @click="show = !show" x-show="!show" x-cloak>
            <x-icons.eye-close />
        </div>
    </div>
</div>
