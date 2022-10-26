<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interference extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category',
        'title',
        'description',
        'status',
        'attachment',
        'finished_at',
        'message',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
