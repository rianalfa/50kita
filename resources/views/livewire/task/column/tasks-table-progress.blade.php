<div class="flex justify-center">
    @if ($value >= 75)
        <x-badge.success class="w-16" text="{{ $value }}%" />
    @elseif ($value >= 50)
        <x-badge.warning class="w-16" text="{{ $value }}%" />
    @elseif ($value > 0)
        <x-badge.error class="w-16" text="{{ $value }}%" />
    @else
        <x-badge.white class="w-16" text="{{ $value }}%" />
    @endif
</div>
