<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mark extends Model
{
    use HasFactory;

    public function markable()
    {
        return $this->morphTo();
    }

    public function pupil()
    {
        return $this->belongsTo(User::class);
    }
}
