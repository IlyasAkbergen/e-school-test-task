<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    public function type()
    {
        return $this->belongsTo(LessonType::class);
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function marks()
    {
        return $this->morphMany(Mark::class, 'markable');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function homework()
    {
       return $this->hasOne(Homework::class);
    }

    public function lesson()
    {
        return $this;
    }
}
