<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    public function student()
    {
        return $this->belongsTo(User::class, 'student_id', 'id');
    }
}
