<?php

namespace App\Http\Livewire\Task;

use App\Http\Controllers\Mail;
use App\Models\Payment;
use App\Models\Task;
use App\Models\User;
use Exception;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;
use PhpOffice\PhpWord\TemplateProcessor;

class PaymentModal extends ModalComponent
{
    public $task;
    public $taskMail;
    public $payment;
    public $descriptions;

    protected function rules() {
        $rules = [
            'payment.amount' => 'required|string|numeric',
            'payment.amount_text' => 'required|string',
        ];

        foreach ($this->descriptions as $key => $description) {
            $rules['descriptions.'.$key.'.text'] = 'required|string';
            $rules['descriptions.'.$key.'.amount'] = 'required|string|numeric';
        }

        return $rules;
    }

    public function mount($taskId) {
        $this->task = Task::whereId($taskId)->first();
        $this->taskMail = $this->task->mail->first();
        $this->payment = new Payment();
        $this->descriptions = [];
    }

    public function addDescription() {
        array_push($this->descriptions, ['text' => '', 'amount' => '0']);
    }

    public function deleteDescription($key) {
        array_splice($this->descriptions,$key,1);
    }

    public function savePayment() {
        $this->validate();

        try {
            $totalAmount = 0;
            foreach ($this->descriptions as $description) {
                $totalAmount += $description['amount'];
            }

            if (!empty($this->descriptions) && (int)$totalAmount != (int)$this->payment->amount) {
                $this->emit('error', 'Jumlah total dan uraian tidak sama');
                return;
            }

            $this->payment->task_mail_id = $this->taskMail->id;
            $this->payment->descriptions = $this->descriptions;
            $this->payment->paid_at = date('Y-m-d');
            $this->payment->save();

            $this->taskMail->status = 3;
            $this->taskMail->save();

            try {
                Mail::makeReceipt($this->task->id);
            } catch (Exception $e) {
                $this->emit('error', 'Gagal membuat kwitansi');
            }

            $this->emit('success', 'Berhasil membuat pembayaran');
            $this->emitTo('team.team-tasks-table', 'reloadTable');
            $this->emitTo('team.team-tasks-calendar-event-modal', 'reloadModal');
            $this->emit('closeModal');
        } catch (Exception $e) {
            $this->emit('error', 'Gagal membuat pembayaran');
        }
    }

    public function render()
    {
        return view('livewire.task.payment-modal');
    }
}
