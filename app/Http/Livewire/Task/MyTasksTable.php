<?php

namespace App\Http\Livewire\Task;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Task;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class MyTasksTable extends DataTableComponent
{
    protected $model = Task::class;
    public $teamId;

    public function mount($teamId=NULL) {
        $this->teamId = $teamId;
    }

    public function builder(): Builder {
        return Task::query()
            ->where('tasks.user_id', auth()->user()->id)
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
                    $builder->where('tasks.user_id', auth()->user()->id)
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
            SelectFilter::make('Progress')
                ->options([
                    '' => 'Semua',
                    '<' => 'Belum Selesai',
                    '=' => 'Selesai',
                ])->filter(function (Builder $builder, string $value) {
                    $builder->where('tasks.user_id', auth()->user()->id)
                        ->where(function($query) {
                            if ($this->teamId) $query->where('team_id', $this->teamId);
                        })->where(function($query) use ($value) {
                            if (!empty($value)) {
                                $query->where('progress', $value, 100);
                            }
                        });
                }),
            SelectFilter::make('Surat')
                ->options([
                    NULL => 'Semua',
                    0 => 'Belum diunggah',
                    1 => 'Belum diterima',
                    2 => 'Belum dibayar',
                    3 => 'Sudah dibayar',
                ])->filter(function (Builder $builder, $value) {
                    $builder->where('tasks.user_id', auth()->user()->id)
                        ->where(function($query) {
                            if ($this->teamId) $query->where('team_id', $this->teamId);
                        })->where(function($query) use ($value) {
                            if ($value !== NULL) {
                                $query->with('mail')
                                    ->where(function ($q) use ($value) {
                                        $q->where('status', $value);
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
                ->hideIf($this->teamId ?? FALSE),
            Column::make("Judul", "title"),
            Column::make("Tanggal Mulai", "start_from")
                ->sortable()
                ->format(
                    fn($value, $row, Column $column) => "<p class='text-center'>".$value."</p>"
                )->html(),
            Column::make("Tanggal Selesai", "due_date")
                ->sortable()
                ->format(
                    fn($value, $row, Column $column) => "<p class='text-center'>".$value."</p>"
                )->html(),
            Column::make("Progress", "progress")
                ->sortable()
                ->view('livewire.team.column.team-tasks-table-progress'),
            Column::make("Attachment", "attachment")
                ->isHidden(),
            Column::make("Action")
                ->label(fn($row, Column $column) => view('livewire.team.column.team-tasks-table-action')->withRow($row)),
            Column::make("Surat Tugas", "mail.status")
                ->sortable()
                ->view('livewire.team.column.team-tasks-mail'),
        ];
    }
}
