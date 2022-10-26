<?php

namespace App\Http\Livewire\Helpdesk\Request;

use App\Models\Request;
use Exception;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class AcceptModal extends ModalComponent
{
    public $requestId;
    public $message;

    protected $rules = [
        'message' => 'nullable|string',
    ];

    public function mount($id) {
        $this->requestId = $id;
        $this->message = "";
    }

    public function acceptRequest() {
        $this->validate();
        try {
            $request = Request::whereId($this->requestId)->first();
            $request->status = 2;
            $request->message = $this->message;
            $request->save();

            $this->emit('closeModal');
            $this->emit('success', 'Berhasil memasukkan pesan diterima');
            $this->emitTo('helpdesk.request.table', 'reloadTable');
        } catch (Exception $e) {
            $this->emit('error', 'Gagal memasukkan pesan diterima');
        }
    }

    public function render()
    {
        return view('livewire.helpdesk.request.accept-modal');
    }
}
