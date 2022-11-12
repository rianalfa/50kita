<?php

namespace App\Http\Livewire\Team;

use App\Models\Team;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class TeamModal extends ModalComponent
{
    public $team;

    protected $rules = [
        "team.name" => "required|string|max:100",
        "team.ro" => "required|string|max:100",
        "team.description" => "nullable|string",
        "team.icon" => "nullable|string",
        "team.color" => "nullable|string",
    ];

    public function mount($id=null) {
        $this->team = Team::whereId($id)->first() ?? new Team();
        $this->team->icon = $this->team->icon ?? 'user-group';
        $this->team->color = $this->team->color ?? 'gray-300';
    }

    public function changeIcon($icon) {
        $this->team->icon = $icon;
    }

    public function changeColor($color) {
        $this->team->color = $color;
    }

    public function saveTeam() {
        $this->validate();
        try {
            $this->team->save();

            $this->emit('success', 'Tim berhasil disimpan');
            $this->emitTo('team.show', 'reloadTeam');
            $this->emit('closeModal');
        } catch (\Exception $e) {
            $this->emit('error', 'Gagal menyimpan data tim');
        }
    }

    public function render()
    {
        return view('livewire.team.team-modal');
    }
}
