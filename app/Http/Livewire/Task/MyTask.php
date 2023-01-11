<?php

namespace App\Http\Livewire\Task;

use Livewire\Component;

class MyTask extends Component
{
    public $tableCalendar;

    public function mount() {
        $this->tableCalendar = false;
    }

    public function render()
    {
        return view('livewire.task.my-task')
            ->layoutData(['title' => 'Tugas Saya']);
    }
}
