<?php

namespace App\Http\Livewire\Team;

use App\Models\Task;
use App\Models\UserTeam;
use Asantibanez\LivewireCalendar\LivewireCalendar;
use Illuminate\Support\Collection;
use Livewire\Component;

class TeamTasksCalendar extends LivewireCalendar
{
    public $teamId;
    public $userId;

    public function events(): Collection
    {
        return Task::query()
            ->where(function ($query) {
                if (!empty($this->teamId))
                    $query->where('team_id', $this->teamId);
            })->where(function ($query) {
                if (!empty($this->userId))
                    $query->where('user_id', $this->userId);
            })->whereDate('due_date', '>=', $this->gridStartsAt)
            ->whereDate('due_date', '<=', $this->gridEndsAt)
            ->get()
            ->map(function (Task $task) {
                return [
                    'id' => $task->id,
                    'title' => $task->user->name,
                    'description' => $task->title,
                    'date' => $task->due_date,
                ];
            });
    }

    public function onEventClick($taskId) {
        $this->emit('openModal', 'team.team-tasks-calendar-event-modal', ['taskId' => $taskId]);
    }

    public function onDayClick($year, $month, $day)
    {
        $chiefId = UserTeam::where('team_id', $this->teamId)
                        ->where('position', 'Ketua')
                        ->first()->id ?? 0;

        if (auth()->user()->hasRole('admin') || auth()->user()->id == $chiefId)
            $this->emit('openModal', 'task.task-modal', ['teamId' => $this->teamId, 'startFrom' => $year."-".$month."-".$day]);
    }
}
