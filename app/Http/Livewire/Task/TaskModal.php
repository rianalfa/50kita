<?php

namespace App\Http\Livewire\Task;

use App\Models\Task;
use App\Models\Team;
use App\Models\UserTeam;
use Carbon\Carbon;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class TaskModal extends ModalComponent
{
    public $task;
    public $teamId;
    public $userId;
    public $startFrom;

    protected $rules = [
        'task.team_id' => 'required|exists:teams,id',
        'task.user_id' => 'required|exists:users,id',
        'task.title' => 'required|string|max:150',
        'task.start_from' => 'nullable|date',
        'task.due_date' => 'required|date',
        'task.description' => 'nullable|string',
    ];

    public function mount($id=null, $teamId=null, $userId=null, $startFrom=null) {
        $this->task = Task::whereId($id)->first() ?? new Task();

        if (empty($this->task->id)) {
            $this->task->team_id = $teamId ?? Team::first()->id;
            $this->task->user_id = $userId ?? UserTeam::where('team_id', $this->task->team_id)->first()->user_id;
            $this->task->start_from = Carbon::parse($startFrom)->format('Y-m-d') ?? date('Y-m-d');
        }
    }

    public function saveTask() {
        $this->validate();
        try {
            $this->task->finished = false;
            $this->task->save();

            $this->emit('success', 'Berhasil menambah tugas');
            $this->emitTo('team.members-table', 'reloadTable');
            $this->emitTo('task.tasks-table', 'reloadTable');
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
