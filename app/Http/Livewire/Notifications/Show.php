<?php

namespace App\Http\Livewire\Notifications;

use Livewire\Component;
use Livewire\WithPagination;

class Show extends Component
{
    use WithPagination;

    private $notifications;
    private $payments;
    private const PAGINATE = 10;

    public function reload()
    {
        $this->notifications = auth()
            ->user()
            ->notifications()
            ->paginate(self::PAGINATE, ['*'], 'notificationsPage');

        $this->payments = auth()
            ->user()
            ->payments()
            ->latest()
            ->paginate(self::PAGINATE, ['*'], 'paymentsPage');
    }

    public function render()
    {
        $this->reload();
        return view('notifications', [
            'notifications' => $this->notifications,
            'payments' => $this->payments,
        ])
            ->layoutData(['title' => "Notifications & Transactions"]);
    }
}
