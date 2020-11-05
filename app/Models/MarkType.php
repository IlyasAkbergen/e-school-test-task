<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarkType extends Model
{
    use HasFactory;

    const MARK_TYPE_EXAMINE = 1;
    const MARK_TYPE_LESSON = 2;
    const MARK_TYPE_AUTO_CHECK = 3;
}
