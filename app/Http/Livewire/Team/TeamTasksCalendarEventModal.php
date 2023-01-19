<?php

namespace App\Http\Livewire\Team;

use App\Http\Controllers\Mail;
use App\Models\Task;
use App\Models\TaskMail;
use App\Models\UserTeam;
use Exception;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class TeamTasksCalendarEventModal extends ModalComponent
{
    public $task;

    protected $listeners = [
        'reloadModal' => '$refresh',
    ];

    public function mount($taskId) {
        $this->task = Task::whereId($taskId)->first();
    }

    public function deleteTask() {
        try {
            $chiefId = UserTeam::where('team_id', $this->teamId)
                        ->where('position', 'Ketua')
                        ->first()->user_id ?? 0;

            if ($this->task->progress == 0 && (auth()->user()->hasRole('admin') || $chiefId == auth()->user()->id)) {
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

    public function downloadMail() {
        try {
            $taskMail = TaskMail::where('task_id', $this->task->id)->first();

            if (empty($taskMail)) {
                $this->emit('error', 'Surat tugas belum dibuat');
                return;
            }

            if (!Storage::exists('public/docs/'.$this->task->start_from.'_'.$taskMail->number.'.docx')) {
                Mail::makeMail($this->task->id);
            }

            return Storage::download('public/docs/'.$this->task->start_from.'_'.$taskMail->number.'.docx');
        } catch (Exception $e) {
            $this->emit('error', 'Surat gagal diunduh');
        }
    }

    public function acceptMail() {
        try {
            $taskMail = TaskMail::where('task_id', $this->task->id)->first();
            $taskMail->status = 2;
            $taskMail->save();

            $this->emit('success', 'Surat berhasil diterima');
            $this->emit('refreshDatatable');
        } catch (Exception $e) {
            $this->emit('error', 'Surat gagal diterima');
        }
    }

    public function downloadReceipt() {
        try {
            $taskMail = $this->task->mail->first();

            if (!Storage::exists('public/docs/receipts/'.$this->task->start_from.'_'.$taskMail->number.'.docx')) {
                Mail::makeReceipt($this->task->id);
            }

            return Storage::download('public/docs/receipts/'.$this->task->start_from.'_'.$taskMail->number.'.docx');
        } catch (Exception $e) {
            $this->emit('error', 'Kwitansi gagal diunduh');
        }
    }

    public function render()
    {
        return view('livewire.team.team-tasks-calendar-event-modal');
    }
}
