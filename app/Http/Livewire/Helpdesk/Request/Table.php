<?php

namespace App\Http\Livewire\Helpdesk\Request;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Request;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class Table extends DataTableComponent
{
    protected $listeners = [
        'reloadTable' => '$refresh',
    ];

    protected $model = Request::class;

    public function query(): Builder {
        if (auth()->user()->hasRole('ipds')) {
            return Request::with('user');
        } else {
            return Request::with('user')
                ->where('user_id', auth()->user()->id);
        }
    }

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
                ->collapseOnTablet()
                ->view('livewire.helpdesk.request.category'),
            Column::make("Judul", "title")
                ->searchable(),
            Column::make("Deskripsi", "description")
                ->view('livewire.helpdesk.request.description'),
            Column::make("Status", "status")
                ->sortable()
                ->view('livewire.helpdesk.request.status'),
            Column::make("Diajukan pada", "created_at")
                ->sortable()
                ->format(fn($value, $row, Column $column) => date('d M Y', strtotime($row->created_at))),
            Column::make("Diselesaikan pada", "finished_at")
                ->sortable()
                ->format(fn($value, $row, Column $column) => !empty($row->finished_at) ? date('d M Y', strtotime($row->created_at)) : "-"),
            Column::make("Action", "id")
                ->view('livewire.helpdesk.request.action'),
            Column::make("Pesan", "message")
                ->hideIf(true),
        ];
    }

    public function acceptRequest($id) {
        if (auth()->user()->hasRole('ipds')) {
            try {
                if (in_array(Request::whereId($id)->first()->status, [0,1])) {
                    $this->emit('openModal', 'helpdesk.request.accept-modal', ['id' => $id]);
                } else {
                    $this->emit('error', 'Gagal menerima permintaan');
                }
            } catch (Exception $e) {
                $this->emit('error', 'Gagal menerima permintaan');
            }
        }
    }

    public function rejectRequest($id) {
        if (auth()->user()->hasRole('ipds')) {
            try {
                if (Request::whereId($id)->first()->status == 0) {
                    $this->emit('openModal', 'helpdesk.request.reject-modal', ['id' => $id]);
                } else {
                    $this->emit('error', 'Gagal menolak permintaan');
                }
            } catch (Exception $e) {
                $this->emit('error', 'Gagal menolak permintaan');
            }
        }
    }

    public function finishRequest($id) {
        if (auth()->user()->hasRole('ipds')) {
            try {
                Request::whereId($id)->update([
                    'status' => 3,
                    'finished_at' => date('Y-m-d'),
                ]);
                $this->emit('reloadTable');
                $this->emit('success', 'Berhasil menyelesaikan permintaan');
            } catch (Exception $e) {
                $this->emit('error', 'Gagal menyelesaikan permintaan');
            }
        }
    }

    public function editRequest($id) {
        $request = Request::whereId($id)->first();
        if ($request->status == 2) {
            $this->emit('error', 'Permintaan telah disetujui');
        } else {
            if ($request->user_id == auth()->user()->id) {
                $this->emit('openModal', 'helpdesk.request.form-modal', ['id' => $id]);
            } else {
                $this->emit('error', 'Gagal mengedit permintaan');
            }
        }
    }

    public function deleteRequest($id) {
        try {
            $request = Request::whereId($id)->first();
            if ($request->user_id == auth()->user()->id) {
                $request->delete();
                $this->emit('reloadTable');
                $this->emit('success', 'Berhasil menghapus permintaan');
            } else {
                $this->emit('error', 'Gagal menghapus permintaan');
            }
        } catch (Exception $e) {
            $this->emit('error', 'Gagal menghapus permintaan');
        }
    }

    public function downloadAttachment($id) {
        try {
            $request = Request::whereId($id)->first();
            return Storage::download("public/requests/".$id.".".$request->attachment);
        } catch (Exception $e) {
            $this->emit('error', 'Gagal mengunduh lampiran');
        }
    }
}
