<?php

namespace App\Http\Livewire\Team;

use App\Models\Task;
use Exception;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class TeamTasksCalendarEventModal extends ModalComponent
{
    public $task;

    public function mount($taskId) {
        $this->task = Task::whereId($taskId)->first();
    }

    public function deleteTask() {
        try {
            if ($this->task->progress == 0 || auth()->user()->hasRole('admin')) {
                $this->task->delete();

                $this->emit('success', 'Berhasil menghapus tugas');
                $this->emitTo('team.team-members-table', 'reloadTable');
                $this->emitTo('team.team-tasks-table', 'reloadTable');
                $this->emit('closeModal');
            } else {
                $this->emit('error', 'Tugas sudah dalam proses pengerjaan');
            }
        } catch (\Exception $e) {
            $this->emit('error', 'Gagal menghapus tugas');
        }
    }

    public function render()
    {
        return view('livewire.team.team-tasks-calendar-event-modal');
    }
}
