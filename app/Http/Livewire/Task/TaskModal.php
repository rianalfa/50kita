<?php

namespace App\Http\Livewire\Task;

use App\Models\Task;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class TaskModal extends ModalComponent
{
    public $task;
    public $teamId;
    public $userId;

    protected $rules = [
        'task.title' => 'required|string|max:150',
        'task.start_from' => 'nullable|date',
        'task.due_date' => 'required|date',
        'task.description' => 'nullable|string',
    ];

    public function mount($id=null, $teamId=null, $userId=null) {
        $this->task = Task::whereId($id)->first() ?? new Task();
        $this->teamId = $teamId;
        $this->userId = $userId;
    }

    public function saveTask() {
        $this->validate();
        try {
            $this->task->user_id = $this->task->user_id ?? $this->userId;
            $this->task->team_id = $this->task->team_id ?? $this->teamId;
            $this->task->start_from = $this->task->start_from ?? date('Y-m-d');
            $this->task->finished = false;
            $this->task->save();

            $this->emit('success', 'Berhasil menambah tugas');
            $this->emitTo('team.team-members-table', 'reloadTable');
            $this->emitTo('team.team-tasks-table', 'reloadTable');
            $this->emit('closeModal');
        } catch (\Exception $e) {
            $this->emit('error', 'Gagal menambah tugas');
        }
    }

    public function render()
    {
        return view('livewire.task.task-modal');
    }
}
