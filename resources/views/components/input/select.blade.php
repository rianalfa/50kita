<select
    {{ $attributes->merge(['class' => 'mt-1 block w-full border-gray-300 rounded-md shadow-sm transition duration-150 ease-in-out sm:text-sm sm:leading-5 focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50']) }}>
    {{ $slot }}
</select>
