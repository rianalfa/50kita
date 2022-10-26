<?php

namespace App\Http\Livewire\Helpdesk\Interference;

use App\Models\Interference;
use Exception;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class RejectModal extends ModalComponent
{
    public $interferenceId;
    public $message;

    protected $rules = [
        'message' => 'nullable|string',
    ];

    public function mount($id) {
        $this->interferenceId = $id;
        $this->message = "";
    }

    public function rejectInterference() {
        $this->validate();
        try {
            $interference = Interference::whereId($this->interferenceId)->first();
            $interference->status = 1;
            $interference->message = $this->message;
            $interference->save();

            $this->emit('closeModal');
            $this->emit('success', 'Berhasil memasukkan pesan ditolak');
            $this->emitTo('helpdesk.interference.table', 'reloadTable');
        } catch (Exception $e) {
            $this->emit('error', 'Gagal memasukkan pesan ditolak');
        }
    }

    public function render()
    {
        return view('livewire.helpdesk.interference.reject-modal');
    }
}
