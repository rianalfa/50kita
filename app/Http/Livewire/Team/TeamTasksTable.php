<?php

namespace App\Http\Livewire\Team;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class TeamTasksTable extends DataTableComponent
{
    protected $model = Task::class;
    public $teamId;

    protected $listeners = [
        'reloadTable' => '$refresh',
    ];

    public function mount($id) {
        $this->teamId = $id;
    }

    public function builder(): Builder {
        return Task::query()
            ->where('tasks.team_id', $this->teamId)
            ->select();
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setDefaultSort('progress', 'asc');
    }

    public function deleteTask($id) {
        try {
            $task = Task::whereId($id)->first();
            if ($task->progress == 0) {
                $task->delete();

                $this->emit('success', 'Berhasil menghapus pekerjaan');
                $this->emitTo('team.team-members-table', 'reloadTable');
                $this->emitTo('team.team-tasks-table', 'reloadTable');
                $this->emit('closeModal');
            } else {
                $this->emit('error', 'Pekerjaan sudah dalam proses pengerjaan');
            }
        } catch (\Exception $e) {
            $this->emit('error', 'Gagal menghapus pekerjaan');
        }
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->isHidden(),
            Column::make("Nama", "user_id")
                ->searchable()
                ->sortable()
                ->format(fn($value, $row, Column $column) => User::whereId($value)->first()->name),
            Column::make("Team id", "team_id")
                ->isHidden(),
            Column::make("Judul", "title"),
            Column::make("Tanggal Mulai", "start_from")
                ->sortable(),
            Column::make("Tanggal Selesai", "due_date")
                ->sortable(),
            Column::make("Progress", "progress")
                ->sortable()
                ->view('livewire.team.team-tasks-table-progress'),
            Column::make("Attachment", "attachment")
                ->isHidden(),
            Column::make("Action")
                ->label(fn($row, Column $column) => view('livewire.team.team-tasks-table-action')->withRow($row)),
        ];
    }
}
