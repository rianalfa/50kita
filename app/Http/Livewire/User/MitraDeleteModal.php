<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Exception;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class MitraDeleteModal extends ModalComponent
{
    public $user;

    public function mount($userId) {
        $this->user = User::whereId($userId)->first();
    }

    public function deleteMitra() {
        try {
            $this->user->delete();

            $this->emit('success', 'Berhasil menghapus mitra');
            $this->emit('closeModal');
            $this->emit('refreshDatatable');
        } catch (Exception $e) {
            $this->emit('error', 'Gagal menghapus mitra');
        }
    }

    public function render()
    {
        return view('livewire.user.mitra-delete-modal');
    }
}
