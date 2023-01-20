<?php

namespace App\Http\Livewire\Task;

use App\Models\Task;
use Exception;
use Livewire\Component;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;

class TaskMailUploadModal extends ModalComponent
{
    use WithFileUploads;

    public $mailFile;
    public $task;

    protected $rules = [
        'mailFile' => 'required|file|file|mimes:docx,doc',
    ];

    public function mount($taskId) {
        $this->task = Task::whereId($taskId)->first();
    }

    public function uploadMail() {
        $this->validate();

        try {
            $this->mailFile->storeAs('public/mails/uploaded', $this->task->start_from.'_'.$this->task->mail->number.'.docx');

            $taskMail = $this->task->mail->first();
            $taskMail->status = 1;
            $taskMail->save();

            $this->emit('success', 'Surat berhasil diunggah');
            $this->emitTo('task.tasks-table', 'reloadTable');
            $this->emitTo('task.tasks-calendar', 'reloadCalendar');
            $this->emitTo('task.tasks-calendar-event-modal', 'reloadModal');
            $this->emit('closeModal');
        } catch (Exception $e) {
            $this->emit('error', 'Surat gagal diunggah');
        }
    }

    public function render()
    {
        return view('livewire.task.task-mail-upload-modal');
    }
}
