<?php

namespace App\Http\Livewire\Helpdesk\Request;

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
        return view('livewire.helpdesk.request.description-modal', [
            'text' => $this->text,
        ]);
    }
}
