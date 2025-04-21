<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class StudentAssignment extends Model
{
    public function student()
    {
        return $this->belongsTo(User::class, 'student_id', 'id');
    }
}
