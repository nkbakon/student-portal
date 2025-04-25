<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Assignment;
use App\Models\StudentAssignment;
use App\Models\TClass;

class AssignmnetController extends Controller
{
    public function index()
    {
        $my_assignments = StudentAssignment::where('student_id', auth()->user()->id)->orderBy('id', 'desc')->paginate(25);
        return view('assignments.index', compact('my_assignments'));
    }
}
