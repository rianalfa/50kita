<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Exception;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class UserRoleModal extends ModalComponent
{
    public $role;
    public $user;

    public function mount($userId) {
        $this->user = User::whereId($userId)->first() ?? [];

        if (empty($this->user)) {
            $this->emit('error', 'User tidak ditemukan');
        }

        $this->role = $this->user->getRoleNames()[0];
    }

    public function saveRole() {
        try {
            $role = $this->user->getRoleNames()[0];
            $this->user->removeRole($role);
            $this->user->assignRole($this->role);

            $this->emit('success', 'Berhasil mengubah jabatan user');
            $this->emit('closeModal');
            $this->emit('refreshDatatable');
        } catch (Exception $e) {
            $this->emit('error', 'Gagal mengubah jabatan user');
        }
    }

    public function render()
    {
        return view('livewire.user.user-role-modal');
    }
}
