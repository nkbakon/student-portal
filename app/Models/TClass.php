<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Subject;
use App\Models\User;

class TClass extends Model
{
    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id', 'id');
    }

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id', 'id');
    }
}
