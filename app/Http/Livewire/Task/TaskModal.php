<?php

namespace App\Http\Livewire\Task;

use App\Models\Task;
use App\Models\TaskMail;
use App\Models\Team;
use App\Models\User;
use App\Models\UserTeam;
use Carbon\Carbon;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class TaskModal extends ModalComponent
{
    public $task;
    public $taskMail;
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
        'taskMail.user_id' => 'required|exists:users,id',
        'taskMail.place' => 'required|string',
        'taskMail.spd' => 'bool',
    ];

    public function mount($id=null, $teamId=null, $userId=null, $startFrom=null) {
        $this->task = Task::whereId($id)->first() ?? new Task();
        $this->taskMail = TaskMail::where('task_id', $id)->first() ?? new TaskMail();

        if (empty($this->task->id)) {
            $this->task->team_id = !empty($teamId) ? $teamId : Team::first()->id;
            $this->task->user_id = !empty($userId) ? $userId : UserTeam::where('team_id', $this->task->team_id)->first()->user_id;
            $this->task->start_from = Carbon::parse($startFrom)->format('Y-m-d') ?? date('Y-m-d');

            $this->taskMail->user_id = User::join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                                    ->where('model_has_roles.role_id', 2)
                                    ->first()->id ?? 0;

            $this->taskMail->note = '';
            $this->taskMail->spd = false;
        }
    }

    public function changeTeam() {
        $this->task->user_id = UserTeam::where('team_id', $this->task->team_id)->first()->user_id;
    }

    public function saveTask() {
        $this->validate();

        try {
            $this->task->finished = false;
            $this->task->save();

            $lastTaskMailNumber = TaskMail::whereYear('created_at', date('Y'))
                                    ->orderBy('number', 'desc')
                                    ->first()->number ?? '001';
            $lastTaskMailNumber = (int)$lastTaskMailNumber+1;

            if ($lastTaskMailNumber < 10) {
                $this->taskMail->number = '00'.$lastTaskMailNumber;
            } elseif ($lastTaskMailNumber < 100) {
                $this->taskMail->number = '0'.$lastTaskMailNumber;
            } else {
                $this->taskMail->number = $lastTaskMailNumber;
            }

            $this->taskMail->task_id = $this->task->id;
            $this->taskMail->code = $this->taskMail->number.'/'.$this->task->team->ro.'/1308/'.date('m').'/'.date('Y');
            $this->taskMail->save();

            $this->emit('success', 'Berhasil menambah tugas');
            $this->emitTo('team.members-table', 'reloadTable');
            $this->emitTo('task.tasks-table', 'reloadTable');
            $this->emitTo('task.tasks-calendar', 'reloadCalendar');
            $this->emitTo('task.tasks-calendar-event-modal', 'reloadModal');
            $this->emit('closeModal');
        } catch (\Exception $e) {
            $this->emit('error', 'Gagal menambah tugas');
        }
    }

    public function render()
    {
        return view('livewire.task.task-modal', [
            'users' => User::join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                        ->where('model_has_roles.role_id', 2)
                        ->get() ?? [],
        ]);
    }
}
