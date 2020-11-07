<?php


namespace App\Traits;

use App\Models\Lesson;

trait HasLesson
{
    public function lesson()
    {
        return $this->belongsTo(Lesson::class)
            ->when($this instanceof Lesson, function ($q) {
                $q->whereNull('id');
            });

    }
}