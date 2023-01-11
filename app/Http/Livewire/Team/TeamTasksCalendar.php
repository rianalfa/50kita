<?php

namespace App\Http\Livewire\Team;

use App\Models\Task;
use Asantibanez\LivewireCalendar\LivewireCalendar;
use Illuminate\Support\Collection;
use Livewire\Component;

class TeamTasksCalendar extends LivewireCalendar
{
    public $teamId;

    public function events(): Collection
    {
        return Task::query()
            ->where('team_id', $this->teamId)
            ->whereDate('due_date', '>=', $this->gridStartsAt)
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
        if (auth()->user()->hasRole('admin')) {
            $this->emit('openModal', 'team.team-tasks-calendar-event-modal', ['taskId' => $taskId]);
        } else {
            $this->emit('openModal', 'task.report-modal', ['taskId' => $taskId]);
        }
    }

    public function onDayClick($year, $month, $day)
    {
        $this->emit('openModal', 'task.task-modal', ['teamId' => $this->teamId, 'startFrom' => $year."-".$month."-".$day]);
    }
}
