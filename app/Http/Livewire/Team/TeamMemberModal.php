<?php

namespace App\Http\Livewire\Team;

use App\Models\User;
use App\Models\UserTeam;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class TeamMemberModal extends ModalComponent
{
    public $teamId;
    public $userTeam;
    protected $users;

    protected $rules = [
        'userTeam.user_id' => 'required|exists:users,id',
    ];

    public function mount($teamId) {
        $this->userTeam = new UserTeam();
        $this->teamId = $teamId;

        $this->users = User::get() ?? [];
        if (!empty($this->users)) $this->userTeam->user_id = $this->users[0]->id;
    }

    public function saveNewMember() {
        $this->validate();
        try {
            $userTeam = UserTeam::where('team_id', $this->teamId)
                            ->where('user_id', $this->userTeam->user_id)
                            ->first() ?? [];
            if (empty($userTeam)) {
                $this->userTeam->team_id = $this->teamId;
                $this->userTeam->position = "Anggota";
                $this->userTeam->save();

                $this->emit('success', 'Anggota berhasil ditambah');
                $this->emitTo('team.team-members-table', 'reloadTable');
                $this->emit('closeModal');
            } else {
                $this->emit('error', 'Anggota sudah ada dalam tim');
            }
        } catch (\Exception $e) {
            $this->emit('error', $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.team.team-member-modal', [
            'users' => $this->users ?? User::get(),
        ]);
    }
}
