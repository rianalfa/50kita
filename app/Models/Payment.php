<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'task_mail_id',
        'amount',
        'amount_text',
        'paid_at',
        'descriptions',
    ];

    protected $casts = [
        'descriptions' => 'array',
    ];

    public function taskMail() {
        return $this->belongsTo(TaskMail::class);
    }
}
