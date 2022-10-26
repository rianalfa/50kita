<?php

namespace App\Http\Livewire\Helpdesk;

use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class DescriptionModal extends ModalComponent
{
    protected $text;

    public function mount($text="") {
        $this->text = $text;
    }

    public function render()
    {
        return view('livewire.helpdesk.description-modal', [
            'text' => $this->text,
        ]);
    }
}
