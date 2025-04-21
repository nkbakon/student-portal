<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\TClass;

class Assignment extends Model
{
    public function class()
    {
        return $this->belongsTo(TClass::class, 'class_id', 'id');
    }
}
