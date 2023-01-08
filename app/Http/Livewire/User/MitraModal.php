<?php

namespace App\Http\Livewire\User;

use App\Constants\Address;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class MitraModal extends ModalComponent
{
    public $user;
    public $subvillage;
    public $village;
    public $district;

    protected $rules = [
        'user.name' => 'required|string|max:255',
        'user.username' => 'required|string|max:50|unique:users',
        'user.email' => 'required|string|email|max:255|unique:users',
        'user.phone_number' => 'required|numeric|digits:10,15|unique:users',
        'subvillage' => 'required|string',
        'village' => 'required|string',
        'district' => 'required|string',
    ];

    public function mount($userId=NULL) {
        $this->user = User::whereId($userId)->first() ?? new User();

        $this->subvillage = $this->user->address->subvillage ?? array_values(Address::subvillages())[0];
        $this->village = $this->user->address->village ?? array_values(Address::villages())[0];
        $this->district = $this->user->address->district ?? array_values(Address::districts())[0];
    }

    public function saveMitra() {
        try {
            $address = [
                'subvillage' => $this->subvillage,
                'village' => $this->village,
                'district' => $this->district,
            ];

            $this->user->email_verified_at = $this->user->email_verified_at ?? date('Y-m-d H:i:s');
            $this->user->password = $this->user->password ?? Hash::make($this->user->username);
            $this->user->address = $address;
            $this->user->save();

            $this->emit('success', 'Berhasil menyimpan mitra');
            $this->emit('closeModal');
            $this->emit('refreshDatatable');
        } catch (Exception $e) {
            $this->emit('error', 'Gagal menyimpan mitra');
        }
    }

    public function render()
    {
        return view('livewire.user.mitra-modal');
    }
}
