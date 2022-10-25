<?php

namespace App\Http\Livewire\Helpdesk;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Request;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class RequestTable extends DataTableComponent
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
                ->view('livewire.helpdesk.request-column.category'),
            Column::make("Judul", "title")
                ->searchable(),
            Column::make("Deskripsi", "description")
                ->view('livewire.helpdesk.request-column.description'),
            Column::make("Status", "status")
                ->sortable()
                ->view('livewire.helpdesk.request-column.status'),
            Column::make("Diajukan pada", "created_at")
                ->sortable()
                ->format(fn($value, $row, Column $column) => date('d M Y', strtotime($row->created_at))),
            Column::make("Action", "id")
                ->view('livewire.helpdesk.request-column.action'),
        ];
    }

    public function acceptRequest($id) {
        if (auth()->user()->hasRole('ipds')) {
            try {
                Request::whereId($id)->update(['status' => 2]);
                $this->emit('reloadTable');
                $this->emit('success', 'Berhasil menerima permintaan');
            } catch (Exception $e) {
                $this->emit('error', 'Gagal menerima permintaan');
            }
        }
    }

    public function rejectRequest($id) {
        if (auth()->user()->hasRole('ipds')) {
            try {
                Request::whereId($id)->update(['status' => 1]);
                $this->emit('reloadTable');
                $this->emit('success', 'Berhasil menerima permintaan');
            } catch (Exception $e) {
                $this->emit('error', 'Gagal menerima permintaan');
            }
        }
    }

    public function editRequest($id) {
        $request = Request::whereId($id)->first();
        if ($request->status == 2) {
            $this->emit('error', 'Permintaan telah disetujui');
        } else {
            if ($request->user_id == auth()->user()->id) {
                $this->emit('openModal', 'helpdesk.request-modal', ['id' => $id]);
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
