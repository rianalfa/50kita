<?php

namespace App\Http\Livewire\Task;

use App\Models\Task;
use App\Models\TaskMail;
use App\Models\User;
use Exception;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class TaskMailModal extends ModalComponent
{
    public $task;
    public $taskMail;

    protected $rules = [
        'taskMail.user_id' => 'required|exists:users,id',
        'taskMail.place' => 'required|string',
        'taskMail.note' => 'string',
        'taskMail.spd' => 'bool',
    ];

    public function mount($taskId) {
        $this->task = Task::whereId($taskId)->first();

        $this->taskMail = TaskMail::where('task_id', $taskId)->first() ?? new TaskMail();

        $this->taskMail->user_id = User::join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                                    ->where('model_has_roles.role_id', 2)
                                    ->first()->id ?? 0;

        $this->taskMail->note = '';
        $this->taskMail->spd = false;
    }

    public function saveTaskMail() {
        $this->validate();

        try {
            $this->taskMail->task_id = $this->task->id;

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

            $this->taskMail->code = $this->task->team->ro.'/'.$this->taskMail->number.'/'.date('m').'/'.date('Y');

            $this->taskMail->save();

            $this->emit('success', 'Berhasil membuat surat tugas');
            $this->emitTo('task.tasks-table', 'reloadTable');
            $this->emitTo('task.tasks-calendar', 'reloadCalendar');
            $this->emitTo('task.tasks-calendar-event-modal', 'reloadModal');
            $this->emit('closeModal');
        } catch (Exception $e) {
            $this->emit('error', $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.task.task-mail-modal', [
            'users' => User::join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                        ->where('model_has_roles.role_id', 2)
                        ->get() ?? [],
        ]);
    }
}
