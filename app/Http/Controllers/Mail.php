<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\TemplateProcessor;

class Mail extends Controller
{
    public static function makeMail($taskId) {
        $task = Task::whereId($taskId)->first();
        $taskMail = $task->mail->first();

        $data = [
            'mailCode' => $taskMail->code,
            'userName' => $task->user->name,
            'userNIP' => $task->user->nip,
            'userFunction' => $task->user->function,
            'taskTitle' => $task->title,
            'taskStartFrom' => date('d F Y', strtotime($task->start_from)),
            'taskDueDate' => date('d F Y', strtotime($task->due_date)),
            'mailSignatureDate' => date('d F Y'),
            'userSignatureFunction' => $taskMail->user->function,
            'userSignatureName' => explode(',',$taskMail->user->name)[0],
        ];

        if ($taskMail->spd) {
            $templateProccessor = new TemplateProcessor('stspdTemplate.docx');

            $ppk = User::join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                    ->where('model_has_roles.role_id', 5)
                    ->first() ?? User::join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                                    ->where('model_has_roles.role_id', 2)
                                    ->first();

            $data['ppkName'] = $ppk->name;
            $data['ppkNIP'] = $ppk->nip;
            $data['userClass'] = $task->user->class;
            $data['userRank'] = $task->user->rank;
            $data['spdRank'] = 1;
            $data['transportation'] = 'Kendaraan Pribadi';
            $data['mailPlace'] = $taskMail->place;
            $data['taskDayDuration'] = (int)((strtotime($task->due_date) - strtotime($task->start_from))/60/60/24);
            $data['userSignatureNIP'] = $taskMail->user->nip;
        } else {
            $templateProccessor = new TemplateProcessor('stTemplate.docx');
        }

        $templateProccessor->setValues($data);

        $templateProccessor->saveAs('storage/docs/'.$task->start_from.'_'.$taskMail->number.'.docx');
    }

    public static function makeReceipt($taskId) {
        $task = Task::whereId($taskId)->first();
        $taskMail = $task->mail->first();
        $payment = Payment::where('task_mail_id', $taskMail->id)->first();

        $finance = User::join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                    ->where('model_has_roles.role_id', 4)
                    ->first() ?? User::join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                                    ->where('model_has_roles.role_id', 2)
                                    ->first();

        $ppk = User::join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                ->where('model_has_roles.role_id', 5)
                ->first() ?? User::join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                                ->where('model_has_roles.role_id', 2)
                                ->first();

        $data = [
            'payAmount' => $payment->amount,
            'taskTitle' => $task->title,
            'mailPlace' => $taskMail->place,
            'taskDayDuration' => (int)((strtotime($task->due_date) - strtotime($task->start_from))/60/60/24),
            'mailCode' => $taskMail->code,
            'taskStartFrom' => date('d F Y', strtotime($task->start_from)),
            'payAmountText' => $payment->amount_text,
            'financeName' => $finance->name,
            'financeNIP' => $finance->nip,
            'ppkName' => $ppk->name,
            'ppkNIP' => $ppk->nip,
            'userName' => $task->user->name,
            'userNIP' => $task->user->nip,
            'userClass' => $task->user->class,
            'payDate' => $payment->paid_at,
        ];

        $descriptions = [];
        foreach ($payment->descriptions as $key => $description) {
            array_push($descriptions, [
                'descNum' => $key+2,
                'descText' => $description['text'],
                'descAmount' => $description['amount'],
            ]);
        }

        $templateProccessor = new TemplateProcessor('kwitansiTemplate.docx');

        $templateProccessor->setValues($data);
        $templateProccessor->cloneRowAndSetValues('descNum', $descriptions);

        $templateProccessor->saveAs('storage/docs/receipts/'.$task->start_from.'_'.$taskMail->number.'.docx');
    }
}
