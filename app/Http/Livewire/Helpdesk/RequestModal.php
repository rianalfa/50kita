<?php

namespace App\Http\Livewire\Helpdesk;

use App\Constants\Request as ConstantsRequest;
use App\Models\Request;
use Exception;
use Livewire\Component;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;

class RequestModal extends ModalComponent
{
    use WithFileUploads;

    public $request;
    public $requestFile;

    protected $rules = [
        'request.category' => 'required|string|max:100',
        'request.subcategory' => 'required|string|max:100',
        'request.title' => 'required|string|max:255',
        'request.description' => 'nullable|string',
        'requestFile' => 'nullable|file|mimes:png,jpg,pdf,doc,docx|max:10240',
    ];

    public function mount($id=Null) {
        $this->request = Request::whereId($id)->first() ?? new Request();
        $this->request->category = $this->request->category ?? "";
        $this->request->subcategory = $this->request->subcategory ?? "";
    }

    public function saveRequest() {
        $this->validate();
        try {
            $this->request->user_id = auth()->user()->id;
            $this->request->status = 0;
            $this->request->attachment = $this->requestFile->extension() ?? "";
            $this->request->save();

            try {
                $this->requestFile->storePubliclyAs('public/requests', (string)$this->request->id.".".$this->requestFile->extension());
            } catch (Exception $e) {
                $this->emit('error', 'Lampiran gagal diunggah');
            }

            $this->emitTo('helpdesk.request-table', 'reloadTable');
            $this->emit('success', 'Permintaan berhasil diajukan');
            $this->emit('closeModal');
        } catch (Exception $e) {
            $this->emit('error', 'Permintaan gagal diajukan');
        }
    }

    public function render()
    {
        return view('livewire.helpdesk.request-modal');
    }
}
