<?php

namespace App\Http\Livewire\Helpdesk;

use App\Models\Request;
use Livewire\Component;

class Main extends Component
{
    protected $listeners = [
        'changeType' => 'changeType',
    ];

    public $type;

    public function mount() {
        $this->type = 0;
    }

    public function changeType($type) {
        $this->type = $type;
    }

    public function render()
    {
        return view('livewire.helpdesk.main')
            ->layout('layouts.app', ['title' => 'Help Desk']);
    }
}
