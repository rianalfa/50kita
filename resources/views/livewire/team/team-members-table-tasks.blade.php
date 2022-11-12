<div class="flex justify-center">
    @php
        $tasks = \App\Models\Task::where('user_id', $row->user_id)
                        ->where('team_id', $row->team_id)
                        ->whereNot('progress', 100)
                        ->count() ?? 0;
    @endphp
    @if ($tasks >= 6)
        <x-badge.error class="w-12" text="{{ $tasks }}" />
    @elseif ($tasks >= 3)
        <x-badge.warning class="w-12" text="{{ $tasks }}" />
    @elseif ($tasks >= 1)
        <x-badge.success class="w-12" text="{{ $tasks }}" />
    @else
        <x-badge.white class="w-12" text="{{ $tasks }}" />
    @endif
</div>
