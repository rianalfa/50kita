<?php

namespace App\Http\Livewire\Team;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

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
            if ($task->progress == 0 || auth()->user()->hasRole('admin')) {
                $task->delete();

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

    public function filters(): array
    {
        return [
            SelectFilter::make('Tahun')
                ->options([
                    '' => 'Semua',
                    '2022' => '2022',
                    '2023' => '2023',
                    '2024' => '2024',
                    '2025' => '2025',
                    '2026' => '2026',
                    '2027' => '2027',
                ])->filter(function (Builder $builder, string $value) {
                    if (!empty($value)) {
                        $builder->where(function ($query) use ($value) {
                                $query->whereYear('start_from', $value)
                                    ->where('team_id', $this->teamId);
                            })->orWhere(function ($query) use ($value) {
                                $query->whereYear('due_date', $value)
                                    ->where('team_id', $this->teamId);
                            });
                    } else {
                        $builder->where('team_id', $this->teamId);
                    }
                }),
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
                    if (!empty($value)) {
                        $builder->where(function ($query) use ($value) {
                            $query->whereMonth('start_from', $value)
                                ->where('team_id', $this->teamId);
                        })->orWhere(function ($query) use ($value) {
                            $query->whereMonth('due_date', $value)
                                ->where('team_id', $this->teamId);
                        });
                    } else {
                        $builder->where('team_id', $this->teamId);
                    }
                }),
            SelectFilter::make('Progress')
                ->options([
                    '' => 'Semua',
                    '0' => 'Belum Dikerjakan',
                    '25' => 'Dibawah 50%',
                    '75' => 'Diatas 50%',
                    '100' => 'Selesai'
                ])->filter(function (Builder $builder, string $value) {
                    if ($value !== '' || $value !== NULL) {
                        $builder->where('team_id', $this->teamId)
                            ->where(function ($query) use ($value) {
                                if ($value == '0') {
                                    $query->where('progress', '0');
                                } elseif ($value == '25') {
                                    $query->where('progress', '<', '50');
                                } elseif ($value == '75') {
                                    $query->where('progress', '>=', '50');
                                } elseif ($value == '100') {
                                    $query->where('progress', '100');
                                }
                            });
                    } else {
                        $builder->where('team_id', $this->teamId);
                    }
                })
        ];
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
        ];
    }
}
