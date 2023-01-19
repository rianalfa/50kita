<?php

namespace App\Http\Livewire\Team;

use App\Http\Controllers\Mail;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Task;
use App\Models\TaskMail;
use App\Models\Team;
use App\Models\User;
use App\Models\UserTeam;
use Exception;
use Faker\Core\Color;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\TemplateProcessor;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class TeamTasksTable extends DataTableComponent
{
    protected $model = Task::class;
    public $teamId;
    public $userId;

    protected $listeners = [
        'reloadTable' => '$refresh',
    ];

    public function mount($teamId=NULL, $userId=NULL) {
        $this->teamId = $teamId;
        $this->userId = $userId;
    }

    public function builder(): Builder {
        return Task::query()
            ->where(function ($query) {
                if (!empty($this->teamId))
                    $query->where('team_id', $this->teamId);
            })->where(function ($query) {
                if (!empty($this->userId))
                    $query->where('tasks.user_id', $this->userId);
            })->select();
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setDefaultSort('progress', 'asc');
    }

    public function deleteTask($id) {
        try {
            $task = Task::whereId($id)->first();
            $chiefId = UserTeam::where('team_id', $this->teamId)
                        ->where('position', 'Ketua')
                        ->first()->user_id ?? 0;

            if ($task->progress == 0 && (auth()->user()->hasRole('admin') || $chiefId == auth()->user()->id)) {
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

    public function downloadMail($taskId) {
        try {
            $task = Task::whereId($taskId)->first();
            $taskMail = TaskMail::where('task_id', $taskId)->first();

            if (empty($taskMail)) {
                $this->emit('error', 'Surat tugas belum dibuat');
                return;
            }

            if (!Storage::exists('public/docs/'.$task->start_from.'_'.$taskMail->number.'.docx')) {
                Mail::makeMail($taskId);
            }

            return Storage::download('public/docs/'.$task->start_from.'_'.$taskMail->number.'.docx');
        } catch (Exception $e) {
            $this->emit('error', 'Surat gagal diunduh');
        }
    }

    public function acceptMail($taskId) {
        try {
            $taskMail = TaskMail::where('task_id', $taskId)->first();
            $taskMail->status = 2;
            $taskMail->save();

            $this->emit('success', 'Surat berhasil diterima');
            $this->emit('refreshDatatable');
        } catch (Exception $e) {
            $this->emit('error', 'Surat gagal diterima');
        }
    }

    public function downloadReceipt($taskId) {
        try {
            $task = Task::whereId($taskId)->first();
            $taskMail = $task->mail->first();

            if (!Storage::exists('public/docs/receipts/'.$task->start_from.'_'.$taskMail->number.'.docx')) {
                Mail::makeReceipt($taskId);
            }

            return Storage::download('public/docs/receipts/'.$task->start_from.'_'.$taskMail->number.'.docx');
        } catch (Exception $e) {
            $this->emit('error', 'Kwitansi gagal diunduh');
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
                    $builder->where(function ($query) {
                            if (!empty($this->teamId))
                                $query->where('team_id', $this->teamId);
                        })->where(function ($query) {
                            if (!empty($this->userId))
                                $query->where('tasks.user_id', $this->userId);
                        })->where(function ($query) use ($value) {
                            if (!empty($value)) {
                                $query->whereYear('start_from', $value)
                                    ->orWhere(function ($q) use ($value) {
                                        $q->whereYear('due_date', $value);
                                    });
                            }
                        });
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
                    $builder->where(function ($query) {
                            if (!empty($this->teamId))
                                $query->where('team_id', $this->teamId);
                        })->where(function ($query) {
                            if (!empty($this->userId))
                                $query->where('tasks.user_id', $this->userId);
                        })->where(function ($query) use ($value) {
                            if (!empty($value)) {
                                $query->whereMonth('start_from', $value)
                                    ->orWhere(function ($q) use ($value) {
                                        $q->whereMonth('due_date', $value);
                                    });
                            }
                        });
                }),
            SelectFilter::make('Progress')
                ->options([
                    '' => 'Semua',
                    '0' => 'Belum Dikerjakan',
                    '25' => 'Dibawah 50%',
                    '75' => 'Diatas 50%',
                    '100' => 'Selesai'
                ])->filter(function (Builder $builder, string $value) {
                    $builder->where(function ($query) {
                            if (!empty($this->teamId))
                                $query->where('team_id', $this->teamId);
                        })->where(function ($query) {
                            if (!empty($this->userId))
                                $query->where('tasks.user_id', $this->userId);
                        })->where(function ($query) use ($value) {
                            if ($value !== '' || $value !== NULL) {
                                if ($value == '0') {
                                    $query->where('progress', '0');
                                } elseif ($value == '25') {
                                    $query->where('progress', '<', '50');
                                } elseif ($value == '75') {
                                    $query->where('progress', '>=', '50');
                                } elseif ($value == '100') {
                                    $query->where('progress', '100');
                                }
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
                    $builder->with('mail')
                        ->where(function ($query) {
                            if (!empty($this->teamId))
                                $query->where('team_id', $this->teamId);
                        })->where(function ($query) {
                            if (!empty($this->userId))
                                $query->where('tasks.user_id', $this->userId);
                        })->where(function($query) use ($value) {
                            if ($value !== NULL)
                                $query->where('status', $value);
                        });
                }),
        ];
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->isHidden(),
            Column::make("Pelaksana", "user_id")
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
            Column::make("Aksi")
                ->label(fn($row, Column $column) => view('livewire.team.column.team-tasks-table-action')->withRow($row)),
            Column::make("Surat Tugas")
                ->label(fn($row, Column $column) => view('livewire.team.column.team-tasks-mail')->withRow($row)),
        ];
    }
}
