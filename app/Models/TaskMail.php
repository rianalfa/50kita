<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskMail extends Model
{
    use HasFactory;

    protected $fillable = [
        'task_id',
        'status',
        'sent_at',
        'accepted_at',
        'paid_at',
        'note',
        'code',
        'number',
        'user_id',
        'place',
        'spd'
    ];

    public function task() {
        return $this->belongsTo(Task::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
