<div class="flex flex-col space-y-2">
    <div class="flex space-x-2">
        <p class="text-gray-700">Jumlah Tim:</p>
        <x-badge.primary text="{{ $row->teams()->count() }}" />
    </div>
    <div class="flex space-x-2">
        <p class="text-gray-700">Beban Kerja:</p>
        <x-badge.secondary text="{{ $row->tasks()->count() }}" />
    </div>
</div>
