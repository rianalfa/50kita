<?php

namespace App\Http\Livewire\Helpdesk\RequestColumn;

use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class RequestDescriptionModal extends ModalComponent
{
    protected $text;

    public function mount($text="") {
        $this->text = $text;
    }

    public function render()
    {
        return view('livewire.helpdesk.request-column.request-description-modal', [
            'text' => $this->text,
        ]);
    }
}
