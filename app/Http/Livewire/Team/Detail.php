<?php

namespace App\Http\Livewire\Team;

use App\Models\Team;
use App\Models\User;
use App\Models\UserTeam;
use Livewire\Component;

class Detail extends Component
{
    public $teamId;
    public $type;
    protected $team;
    protected $chief;

    public function mount($id) {
        $this->teamId = $id;
        $this->type = 0;
    }

    public function reload() {
        $this->team = Team::whereId($this->teamId)->first();

        $chief = UserTeam::where('team_id', $this->team->id)
                        ->where('position', 'Ketua')
                        ->first() ?? [];

        if (!empty($chief)) {
            $this->chief = User::whereId($chief->user_id)->first() ?? new User();
            $this->chief->id = 0;
        } else {
            $this->chief = new User();
            $this->chief->id = 0;
        }
    }

    public function render()
    {
        $this->reload();
        return view('livewire.team.detail', [
            'team' => $this->team,
            'chief' => $this->chief,
        ])->layoutData(['title' => 'Detail Tim']);
    }
}
