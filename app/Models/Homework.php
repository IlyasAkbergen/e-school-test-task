<?php

namespace App\Models;

use App\Traits\HasLesson;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Homework extends Model
{
    use HasFactory, HasLesson;

    protected $table = 'homeworks';

    public function marks()
    {
        return $this->morphMany(Mark::class, 'markable');
    }

    public function subject()
    {
        return $this->relationLoaded('lesson.subject')
            ? $this->lesson->subject
            : $this->hasOneThrough(
                Subject::class,
                Lesson::class,
                'id',
                'id',
                'lesson_id',
                'subject_id'
                );
    }
}
