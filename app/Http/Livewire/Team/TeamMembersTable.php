<?php

namespace App\Http\Livewire\Team;

use App\Models\Task;
use App\Models\Team;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\UserTeam;
use Illuminate\Database\Eloquent\Builder;

class TeamMembersTable extends DataTableComponent
{
    protected $model = UserTeam::class;
    public $teamId;

    protected $listeners = [
        'reloadTable' => '$refresh',
    ];

    public function mount($id) {
        $this->teamId = $id;
    }

    public function builder(): Builder {
        return UserTeam::query()
            ->with('user')
            ->where('user_teams.team_id', $this->teamId)
            ->select();
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setDefaultSort('position', 'desc');
    }

    public function makeChief($userId) {
        try {
            if (auth()->user()->hasRole('ipds')) {
                $team = Team::whereId($this->teamId)->first();
                $users = $team->users()->get() ?? [];

                foreach ($users as $user) {
                    $user->position = 'Anggota';
                    $user->save();
                }

                UserTeam::where('user_id', $userId)->update(['position' => 'Ketua']);

                $this->emit('success', 'Berhasil mengganti ketua tim');
                $this->emit('reloadTable');
            }
        } catch (\Exception $e) {
            $this->emit('error', 'Gagal mengganti ketua tim');
        }
    }

    public function deleteMember($userId) {
        try {
            $user = UserTeam::where('user_id', auth()->user()->id)
                        ->where('team_id', $this->teamId)
                        ->first() ?? [];

            if (auth()->user()->hasRole('ipds') || (!empty($user) && $user->position=='Ketua')) {
                $user = UserTeam::where('user_id', $userId)->first() ?? [];
                if ($user->position=='Anggota') {
                    Task::where('user_id', $user->user_id)
                        ->where('team_id', $user->team_id)
                        ->delete();

                    $user->delete();

                    $this->emit('success', 'Berhasil menghapus anggota');
                    $this->emit('reloadTable');
                    $this->emitTo('team.team-tasks-table', 'reloadTable');
                } else {
                    $this->emit('error', 'Ketua tidak bisa dihapus');
                }
            }
        } catch (\Exception $e) {
            $this->emit('error', 'Gagal menghapus anggota');
        }
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->isHidden(),
            Column::make("User id", "user_id")
                ->isHidden(),
            Column::make("Nama", "user.name")
                ->searchable()
                ->sortable(),
            Column::make("Posisi", "position")
                ->sortable(),
            Column::make("Beban Kerja")
                ->label(fn($row, Column $column) => view('livewire.team.team-members-table-tasks')->withRow($row)),
            Column::make("Actions")
                ->label(fn($row, Column $column) => view('livewire.team.team-members-table-action')->withRow($row)),
        ];
    }
}
