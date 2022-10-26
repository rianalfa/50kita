<?php

namespace App\Http\Livewire\Helpdesk\Interference;

use App\Models\Interference;
use Livewire\Component;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;

class FormModal extends ModalComponent
{
    use WithFileUploads;

    public $interference;
    public $interferenceFile;

    protected $rules = [
        'interference.category' => 'required|string|max:100',
        'interference.title' => 'required|string|max:255',
        'interference.description' => 'required|string',
        'interferenceFile' => 'nullable|file|mimes:png,jpg,pdf,doc,docx|max:10240',
    ];

    public function mount($id=Null) {
        $this->interference = Interference::whereId($id)->first() ?? new Interference();
        $this->interference->category = $this->interference->category ?? "";
    }

    public function saveInterference() {
        $this->validate();
        try {
            $this->interference->user_id = auth()->user()->id;
            $this->interference->status = 0;
            $this->interference->attachment = $this->interferenceFile->extension() ?? "";
            $this->interference->save();

            try {
                $this->interferenceFile->storePubliclyAs('public/interferences', (string)$this->interference->id.".".$this->interferenceFile->extension());
            } catch (\Exception $e) {
                $this->emit('error', 'Lampiran gagal diunggah');
            }

            $this->emitTo('helpdesk.main', 'changeType', '2');
            $this->emit('success', 'Gangguan berhasil diadukan');
            $this->emit('closeModal');
        } catch (\Exception $e) {
            $this->emit('error', 'Gangguan gagal diadukan');
        }
    }

    public function render()
    {
        return view('livewire.helpdesk.interference.form-modal');
    }
}
