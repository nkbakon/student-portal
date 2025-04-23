<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Assignment;
use App\Models\StudentAssignment;
use App\Models\TClass;
use App\Models\ClassStudent;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ClassController extends Controller
{
    public function index()
    {
        $classes = TClass::orderBy('id', 'desc')->paginate(25);
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
        if(auth()->user()->type != '3'){
            $assigns = ClassStudent::where('class_id', $class->id)->orderBy('id', 'desc')->paginate(25);
            $assigns_count = ClassStudent::where('class_id', $class->id)->count();
            return view('classes.view', compact('class', 'assigns', 'assigns_count'));
        }else{
            $assignments = Assignment::where('class_id', $class->id)->orderBy('id', 'desc')->paginate(25);
            $assignment_count = Assignment::where('class_id', $class->id)->count();
            return view('classes.view_assignment', compact('class', 'assignments', 'assignment_count'));
        }
        
    }

    public function viewAssignment(TClass $class)
    {
        $assignments = Assignment::where('class_id', $class->id)->orderBy('id', 'desc')->paginate(25);
        $assignment_count = Assignment::where('class_id', $class->id)->count();
        return view('classes.view_assignment', compact('class', 'assignments', 'assignment_count'));
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

    public function viewAssign(ClassStudent $assign)
    {
        $class = TClass::find($assign->class_id);
        return view('classes.view_assign', compact('class', 'assign'));        
    }

    public function edit(TClass $class)
    {
        return view('classes.edit', compact('class'));
    }

    public function update(Request $request, TClass $class)
    {
        $request->validate([
            'teacher_id' => 'required',
            'subject_id' => 'required',
            'name' => 'required',
        ]);

        $class->name = $request->name;
        $class->teacher_id = $request->teacher_id;
        $class->subject_id = $request->subject_id;
        $class->status = $request->status;
        $class->save();
        
        return redirect()->route('classes.index')->with('success', 'Class updated successfully.');
    }

    public function destroy(Request $request)
    {
        $class = TClass::find($request->data_id);
        if($class)
        {  
            $class_students = ClassStudent::where('class_id', $class->id)->delete();
            $assignments = Assignment::where('class_id', $class->id)->delete();
            $student_assignments = StudentAssignment::where('class_id', $class->id)->delete();
            $class->delete();
            return redirect()->route('classes.index')->with('delete', 'Class deleted successfully.');
        }
        else
        {
            return redirect()->route('classes.index')->with('delete', 'No class found!.');
        }    
    }

    public function assignment(TClass $class)
    {
        return view('classes.assignment', compact('class'));
    }

    public function storeAssignment(Request $request, TClass $class)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $assignment = new Assignment();
        $assignment->class_id = $class->id;
        $assignment->name = $request->name;
        $assignment->due_date = $request->due_date;
        $assignment->zoom = $request->zoom;
        $assignment->whatsapp = $request->whatsapp;
        $assignment->youtube = $request->youtube;
        $assignment->note = $request->note;
        $assignment->save();

        $attachment = $request->file('attachment');
        $folderName = 'attachments';        
        $path = $attachment->store($folderName, 'public');
        $originalFileName = $attachment->getClientOriginalName();
        $assignment->attachment = $path;
        $assignment->file_name = $originalFileName;
        $assignment->save();

        $class_students = ClassStudent::where('class_id', $class->id)->get();
        foreach($class_students as $class_student){
            $student_assignment = new StudentAssignment();
            $student_assignment->class_id = $class->id;
            $student_assignment->assignment_id = $assignment->id;
            $student_assignment->student_id = $class_student->student_id;
            $student_assignment->save();
        }

        if($assignment){
            return redirect()->route('classes.view_assignment', ['class' => $class->id])
            ->with('status', 'Assignment stored successfully.');        
        }
        return redirect()->route('classes.view_assignment', ['class' => $class->id])
        ->with('delete', 'Assignment astore failed, try again!');
    }

    public function edit_assignment(Assignment $assignment)
    {
        return view('classes.edit_assignment', compact('assignment'));
    }

    public function update_assignment(Request $request, Assignment $assignment)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $assignment->name = $request->name;
        $assignment->due_date = $request->due_date;
        $assignment->zoom = $request->zoom;
        $assignment->whatsapp = $request->whatsapp;
        $assignment->youtube = $request->youtube;
        $assignment->note = $request->note;
        $assignment->save();

        if($request->hasFile('update_attachment')) {
            if($assignment->attachment != null){
                Storage::disk('public')->delete($assignment->attachment);
                $assignment->attachment = null;
                $assignment->file_name = null;
                $assignment->save();
            }
        
            $update_attachment = $request->file('update_attachment');
            $folderName = 'attachments';        
            $path_attachment = $update_attachment->store($folderName, 'public');
            $originalFileName = $update_attachment->getClientOriginalName();
    
            $assignment->attachment = $path_attachment;
            $assignment->file_name = $originalFileName;
            $assignment->save();

        }elseif(!$request->hasFile('update_attachment') && $request->attachments_remove == "1"){
            if($assignment->attachment != null){
                Storage::disk('public')->delete($assignment->attachment);
                $assignment->attachment = null;
                $assignment->file_name = null;
                $assignment->save();
            }
        }
        
        return redirect()->route('classes.view_assignment', ['class' => $assignment->class->id])
            ->with('success', 'Assignment updated successfully.'); 
    }

    public function destroyAssignment(Request $request, TClass $class)
    {
        $assignment = Assignment::find($request->data_id);
        if($assignment)
        {
            if($assignment->attachment != null){
                $attachment = $assignment->attachment;
                Storage::disk('public')->delete($attachment);
            }

            $assignment->delete();
            
            return redirect()->route('classes.view_assignment', ['class' => $class->id])
            ->with('delete', 'Assignment deleted successfully.!'); 
        }
        else
        {
            return redirect()->route('classes.view_assignment', ['class' => $class->id])
            ->with('delete', 'No assignment found!'); 
        }    
    }

    public function submission(Assignment $assignment)
    {
        $my_submission = null;
        if(auth()->user()->type == '3'){
            $student_assignments = StudentAssignment::where('assignment_id', $assignment->id)->where('student_id', auth()->user()->id)->orderBy('id', 'desc')->paginate(25);
            $my_submission = StudentAssignment::where('assignment_id', $assignment->id)->where('student_id', auth()->user()->id)->first();
        }else{
            $student_assignments = StudentAssignment::where('assignment_id', $assignment->id)->orderBy('id', 'desc')->paginate(25);
        }
        
        return view('classes.submission', compact('assignment', 'student_assignments', 'my_submission'));
    }

    public function storeSubmission(Request $request, StudentAssignment $my_submission)
    {
        $request->validate([
            'submission' => 'required',
        ]);

        if($my_submission->submission != null){
            $attachment = $my_submission->submission;
            Storage::disk('public')->delete($attachment);
            $my_submission->submission = null;
            $my_submission->file_name = null;
            $my_submission->save();
        }

        if($my_submission->submission == null){
            $submission = $request->file('submission');
            $folderName = 'attachments';        
            $path = $submission->store($folderName, 'public');
            $originalFileName = $submission->getClientOriginalName();
            $my_submission->submission = $path;
            $my_submission->file_name = $originalFileName;
            $my_submission->save();
        }

        $my_submission->status = 2;
        $my_submission->save();

        $assignment = Assignment::find($my_submission->assignment_id);

        if($my_submission){
            return redirect()->route('classes.submission', ['assignment' => $assignment->id])
            ->with('status', 'Submission stored successfully.');        
        }
        return redirect()->route('classes.submission', ['assignment' => $assignment->id])
        ->with('delete', 'Submission store failed, try again!');
    }

    public function destroySubmission(Request $request, Assignment $assignment)
    {
        $my_submission = StudentAssignment::find($request->data_id);
        if($my_submission)
        {
            if($my_submission->submission != null){
                $attachment = $my_submission->submission;
                Storage::disk('public')->delete($attachment);
            }

            $my_submission->delete();
            
            return redirect()->route('classes.submission', ['assignment' => $assignment->id])
            ->with('delete', 'Submission deleted successfully.!'); 
        }
        else
        {
            return redirect()->route('classes.submission', ['assignment' => $assignment->id])
            ->with('delete', 'No submission found!'); 
        }    
    }

    public function viewSubmission(StudentAssignment $student_assignment)
    {        
        return view('classes.view_submission', compact('student_assignment'));
    }

    public function checkSubmission(Request $request, StudentAssignment $student_assignment)
    {
        $request->validate([
            'status' => 'required',
        ]);
        
        $student_assignment->comment = $request->comment;
        $student_assignment->status = $request->status;
        $student_assignment->save();

        $assignment = Assignment::find($student_assignment->assignment_id);

        if($student_assignment){
            return redirect()->route('classes.submission', ['assignment' => $assignment->id])
            ->with('success', 'Submission checked successfully.');        
        }
        return redirect()->route('classes.submission', ['assignment' => $assignment->id])
        ->with('delete', 'Submission check failed, try again!');
    }
}
