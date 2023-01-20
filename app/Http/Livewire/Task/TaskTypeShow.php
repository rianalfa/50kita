<?php

namespace App\Http\Livewire\Task;

use App\Models\TaskType;
use Livewire\Component;

class TaskTypeShow extends Component
{
    protected $taskTypes;

    protected $listeners = [
        'reloadTaskType' => '$refresh',
    ];

    public function reload() {
        $this->taskTypes = TaskType::get() ?? [];
    }

    public function render()
    {
        $this->reload();
        return view('livewire.task.task-type-show', ['taskTypes' => $this->taskTypes]);
    }
}
