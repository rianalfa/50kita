<?php

namespace App\Http\Livewire\Team;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Task;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class TeamMyTasksTable extends DataTableComponent
{
    protected $model = Task::class;
    public $teamId;

    public function mount($teamId=NULL) {
        $this->teamId = $teamId;
    }

    public function builder(): Builder {
        return Task::query()
            ->where('user_id', auth()->user()->id)
            ->where(function($query) {
                if ($this->teamId) $query->where('team_id', $this->teamId);
            })->select();
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function filters(): array
    {
        return [
            SelectFilter::make('Bulan')
                ->options([
                    '' => 'Semua',
                    '01' => 'Januari',
                    '02' => 'Februari',
                    '03' => 'Maret',
                    '04' => 'April',
                    '05' => 'Mei',
                    '06' => 'Juni',
                    '07' => 'Juli',
                    '08' => 'Agustus',
                    '09' => 'September',
                    '10' => 'Oktober',
                    '11' => 'November',
                    '12' => 'Desember',
                ])->filter(function (Builder $builder, string $value) {
                    $builder->where('user_id', auth()->user()->id)
                        ->where(function($query) {
                            if ($this->teamId) $query->where('team_id', $this->teamId);
                        })->where(function($query) use ($value) {
                            if (!empty($value)) {
                                $query->whereMonth('start_from', $value)
                                    ->orWhere(function($q) use ($value) {
                                        $q->whereMonth('due_date', $value);
                                    });
                            }
                        });
                }),
            ];
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->isHidden(),
            Column::make("Tim", "team.name")
                ->searchable()
                ->sortable()
                ->hideIf($this->teamId),
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
