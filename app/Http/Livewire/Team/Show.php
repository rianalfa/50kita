<?php

namespace App\Http\Livewire\Team;

use App\Models\Team;
use Livewire\Component;

class Show extends Component
{
    public $type;
    protected $teams;

    protected $listeners = [
        'reloadTeam' => 'reload',
    ];

    public function mount() {
        $this->type = false;
    }

    public function reload() {
        if ($this->type) {
            $this->teams = auth()->user()->team->teams->get() ?? [];
        } else {
            $this->teams = Team::get() ?? [];
        }
    }

    public function openTeamDetail($id) {
        return redirect()->route('teams.detail', ['id' => $id]);
    }

    public function deleteTeam($id) {
        try {
            $team = Team::whereId($id)->first() ?? [];
            if (!empty($team)) $team->delete();

            $this->emit('success', 'Berhasil menghapus tim');
            $this->emit('reloadTeam');
        } catch (\Exception $e) {
            $this->emit('error', 'Gagal menghapus tim');
        }
    }

    public function render()
    {
        $this->reload();
        return view('livewire.team.show', [
            'teams' => $this->teams,
        ])->layoutData([
            'title' => 'Tim',
        ]);
    }
}
