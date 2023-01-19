<?php

namespace App\Http\Livewire\Task;

use App\Models\Report;
use App\Models\Task;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class ReportModal extends ModalComponent
{
    public $taskId;
    public $report;

    protected $rules = [
        'report.progress' => 'required|numeric|min:10|max:100',
        'report.description' => 'nullable|string',
    ];

    public function mount($taskId) {
        $this->taskId = $taskId;
        $this->report = new Report();
        $this->report->progress = 0;
    }

    public function saveReport() {
        $this->validate();
        try {
            $task = Task::whereId($this->taskId)->first();
            if (($task->progress + $this->report->progress) <= 100) {
                $this->report->task_id = $this->taskId;
                $this->report->save();

                $task->progress = $task->progress + $this->report->progress;
                $task->save();

                $this->emit('success', 'Berhasil menambah progress');
                $this->emitTo('team.team-tasks-table', 'reloadTable');
                $this->emitTo('team.team-tasks-calendar-event-modal', 'reloadModal');
                $this->emit('closeModal');
            } else {
                $this->emit('error', 'Jumlah progress melebihi 100%');
            }
        } catch (\Exception $e) {
            $this->emit('error', $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.task.report-modal');
    }
}
