<?php

namespace App\Http\Livewire\Helpdesk\Interference;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Interference;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class Table extends DataTableComponent
{
    protected $listeners = [
        'reloadTable' => '$refresh',
    ];

    protected $model = Interference::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function filters(): array
    {
        return [
            SelectFilter::make("Status")->options([
                '' => 'Semua',
                '0' => 'Menunggu',
                '1' => 'Ditolak',
                '2' => 'Diterima',
                '3' => 'Selesai',
            ])->filter(function(Builder $builder, string $value) {
                $builder->where('status', $value);
            }),
        ];
    }

    public function columns(): array
    {
        return [
            Column::make("Nama", "user.name")
                ->sortable()
                ->searchable(),
            Column::make("Kategori", "category")
                ->sortable()
                ->searchable()
                ->collapseOnTablet(),
            Column::make("Judul", "title")
                ->searchable(),
            Column::make("Deskripsi", "description")
                ->view('livewire.helpdesk.interference.description'),
            Column::make("Status", "status")
                ->sortable()
                ->view('livewire.helpdesk.interference.status'),
            Column::make("Diajukan pada", "created_at")
                ->sortable()
                ->format(fn($value, $row, Column $column) => date('d M Y', strtotime($row->created_at))),
            Column::make("Diselesaikan pada", "finished_at")
                ->sortable()
                ->format(fn($value, $row, Column $column) => !empty($row->finished_at) ? date('d M Y', strtotime($row->created_at)) : "-"),
            Column::make("Action", "id")
                ->view('livewire.helpdesk.interference.action'),
            Column::make("Pesan", "message")
                ->hideIf(true),
        ];
    }

    public function acceptInterference($id) {
        if (auth()->user()->hasRole('ipds')) {
            try {
                if (in_array(Interference::whereId($id)->first()->status, [0,1])) {
                    $this->emit('openModal', 'helpdesk.interference.accept-modal', ['id' => $id]);
                } else {
                    $this->emit('error', 'Gagal menerima pengaduan');
                }
            } catch (\Exception $e) {
                $this->emit('error', 'Gagal menerima pengaduan');
            }
        }
    }

    public function rejectInterference($id) {
        if (auth()->user()->hasRole('ipds')) {
            try {
                if (Interference::whereId($id)->first()->status == 0) {
                    $this->emit('openModal', 'helpdesk.interference.reject-modal', ['id' => $id]);
                } else {
                    $this->emit('error', 'Gagal menolak pengaduan');
                }
            } catch (\Exception $e) {
                $this->emit('error', 'Gagal menolak pengaduan');
            }
        }
    }

    public function finishInterference($id) {
        if (auth()->user()->hasRole('ipds')) {
            try {
                Interference::whereId($id)->update([
                    'status' => 3,
                    'finished_at' => date('Y-m-d'),
                ]);
                $this->emit('reloadTable');
                $this->emit('success', 'Berhasil menyelesaikan pengaduan');
            } catch (\Exception $e) {
                $this->emit('error', 'Gagal menyelesaikan pengaduan');
            }
        }
    }

    public function editInterference($id) {
        $interference = Interference::whereId($id)->first();
        if ($interference->status == 2) {
            $this->emit('error', 'Permintaan telah disetujui');
        } else {
            if ($interference->user_id == auth()->user()->id) {
                $this->emit('openModal', 'helpdesk.interference.form-modal', ['id' => $id]);
            } else {
                $this->emit('error', 'Gagal mengedit pengaduan');
            }
        }
    }

    public function deleteInterference($id) {
        try {
            $interference = Interference::whereId($id)->first();
            if ($interference->user_id == auth()->user()->id) {
                $interference->delete();
                $this->emit('reloadTable');
                $this->emit('success', 'Berhasil menghapus pengaduan');
            } else {
                $this->emit('error', 'Gagal menghapus pengaduan');
            }
        } catch (\Exception $e) {
            $this->emit('error', 'Gagal menghapus pengaduan');
        }
    }

    public function downloadAttachment($id) {
        try {
            $request = Interference::whereId($id)->first();
            return Storage::download("public/interferences/".$id.".".$request->attachment);
        } catch (\Exception $e) {
            $this->emit('error', 'Gagal mengunduh lampiran');
        }
    }
}
