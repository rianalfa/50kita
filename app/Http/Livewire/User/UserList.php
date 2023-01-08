<?php

namespace App\Http\Livewire\User;

use Livewire\Component;

class UserList extends Component
{
    public function render()
    {
        return view('livewire.user.user-list')
            ->layoutData([
                'title' => 'Tim',
            ]);;
    }
}
