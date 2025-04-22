<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Assignment;

class StudentAssignment extends Model
{
    public function student()
    {
        return $this->belongsTo(User::class, 'student_id', 'id');
    }

    public function assignment()
    {
        return $this->belongsTo(Assignment::class, 'assignment_id', 'id');
    }
}
