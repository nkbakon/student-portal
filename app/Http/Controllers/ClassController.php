<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TClass;
use App\Models\ClassStudent;

class ClassController extends Controller
{
    public function index()
    {
        $classes = TClass::where('status', 1)->paginate(25);
        return view('classes.index', compact('classes'));
    }

    public function create()
    {
        return view('classes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'teacher_id' => 'required',
            'subject_id' => 'required',
            'name' => 'required',
        ]);

        $class = new TClass();
        $class->name = $request->name;
        $class->teacher_id = $request->teacher_id;
        $class->subject_id = $request->subject_id;
        $class->save();

        if($class){
            return redirect()->route('classes.index')->with('status', 'Class stored successfully.');        
        }
        return redirect()->route('classes.index')->with('delete', 'Class store faild, try again!');
    }

    public function view(TClass $class)
    {
        $assigns = ClassStudent::where('class_id', $class->id)->paginate(25);
        $assigns_count = ClassStudent::where('class_id', $class->id)->count();
        return view('classes.view', compact('class', 'assigns', 'assigns_count'));
    }

    public function assign(Request $request, TClass $class)
    {
        $request->validate([
            'student_id' => 'required',
        ]);

        $class_student = new ClassStudent();
        $class_student->class_id = $class->id;
        $class_student->student_id = $request->student_id;
        $class_student->save();

        if($class_student){
            return redirect()->route('classes.view', ['class' => $class->id])
            ->with('status', 'Student assigned successfully.');        
        }
        return redirect()->route('classes.view', ['class' => $class->id])
        ->with('delete', 'Student assign failed, try again!');
    }

    public function destroyAssign(Request $request, TClass $class)
    {
        $class_student = ClassStudent::find($request->data_id);
        if($class_student)
        {
            $class_student->delete();
            return redirect()->route('classes.view', ['class' => $class->id])
            ->with('delete', 'Student assign deleted successfully!');
        }
        else
        {
            return redirect()->route('classes.view', ['class' => $class->id])
            ->with('delete', 'No student assign found!');
        }    
    }
}
