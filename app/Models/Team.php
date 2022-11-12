<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'ro',
        'description',
        'icon',
        'color'
    ];

    public function users() {
        return $this->hasMany(UserTeam::class);
    }

    public function tasks() {
        return $this->hasMany(Task::class);
    }
}
