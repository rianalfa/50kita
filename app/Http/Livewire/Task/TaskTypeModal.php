<?php

namespace App\Http\Livewire\Task;

use App\Models\TaskType;
use Exception;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class TaskTypeModal extends ModalComponent
{
    public $taskType;

    protected $rules = [
        'taskType.title' => 'required|string|max:250',
        'taskType.description' => 'nullable',
    ];

    public function mount($id=NULL) {
        $this->taskType = TaskType::whereId($id)->first() ?? new TaskType();
    }

    public function saveType() {
        $this->validate();
        try {
            $this->taskType->user_id = auth()->user()->id;
            $this->taskType->save();

            $this->emit('success', 'Berhasil menyimpan jenis tugas');
            $this->emitTo('task.task-type-show', 'reloadTaskType');
            $this->emit('closeModal');
        } catch (Exception $e) {
            $this->emit('error', 'Gagal menyimpan jenis tugas');
        }
    }

    public function render()
    {
        return view('livewire.task.task-type-modal');
    }
}
