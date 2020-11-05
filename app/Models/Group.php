<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    public function pupils()
    {
        return $this->hasMany(User::class);
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }
}
