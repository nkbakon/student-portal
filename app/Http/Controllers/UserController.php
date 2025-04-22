<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\StudentSubject;
use App\Models\TeacherSubject;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $students = User::where('type', 3)->orderBy('id', 'desc')->paginate(25);
        return view('users.index', compact('students'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'type' => 'required',
            'district' => 'required',
            'address' => 'required',
            'gender' => 'required',
            'contact' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|unique:users,contact',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|regex:/^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&#])[A-Za-z\d@$!%*?&#]{6,}$/',
            'confirm_password' => 'required|same:password',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->type = $request->type;
        $user->contact = $request->contact;
        $user->email = $request->email;
        $user->district = $request->district;
        $user->address = $request->address;
        if($user->type == 3){
            $user->parent_name = $request->parent_name;
            $user->parent_contact = $request->parent_contact;
            $user->parent_name2 = $request->parent_name2;
            $user->parent_contact2 = $request->parent_contact2;
            $user->exam = $request->exam;
            $user->dob = $request->dob;
        }
        $user->gender = $request->gender;
        $user->password = Hash::make($request->password);
        $user->save();

        if($user->type == 3){
            foreach($request->subjects as $subject){
                $picked_subject = new StudentSubject();
                $picked_subject->student_id = $user->id;
                $picked_subject->subject_id = $subject;
                $picked_subject->save();
            }
        }
        
        if($user->type == 2){
            foreach($request->subjects as $subject){
                $teach_subject = new TeacherSubject();
                $teach_subject->teacher_id = $user->id;
                $teach_subject->subject_id = $subject;
                $teach_subject->save();
            }
        }

        if($user){
            if($user->type == 3){
                return redirect()->route('users.index')->with('status', 'Student registrated successfully.');
            }else{
                return redirect()->route('users.staff')->with('status', 'Staff registrated successfully.');
            }            
        }
        return redirect()->route('users.index')->with('delete', 'User registration faild, try again.');
    }

    public function edit(User $user)
    {
        if($user->type == 3){
            return view('users.edit', compact('user'));
        }else{
            return view('users.edit_staff', compact('user'));
        }
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'type' => 'required',
            'district' => 'required',
            'address' => 'required',
            'gender' => 'required',
            'contact' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|unique:users,contact, ' . $user->id,
            'email' => 'required|email|unique:users,email,' . $user->id,
            'status' => 'required',
        ]);

        $user->name = $request->name;
        $user->type = $request->type;
        $user->contact = $request->contact;
        $user->email = $request->email;
        $user->district = $request->district;
        $user->address = $request->address;
        if($user->type == 3){
            $user->parent_name = $request->parent_name;
            $user->parent_contact = $request->parent_contact;
            $user->parent_name2 = $request->parent_name2;
            $user->parent_contact2 = $request->parent_contact2;
            $user->exam = $request->exam;
            $user->dob = $request->dob;
        }
        $user->gender = $request->gender;
        $user->status = $request->status;
        $user->save();

        if($user->type == 3){
            $old_subjects = StudentSubject::where('student_id', $user->id)->delete();
            foreach($request->subjects as $subject){
                $picked_subject = new StudentSubject();
                $picked_subject->student_id = $user->id;
                $picked_subject->subject_id = $subject;
                $picked_subject->save();
            }
        }
        
        if($user->type == 2){
            $old_subjects = TeacherSubject::where('teacher_id', $user->id)->delete();
            foreach($request->subjects as $subject){
                $teach_subject = new TeacherSubject();
                $teach_subject->teacher_id = $user->id;
                $teach_subject->subject_id = $subject;
                $teach_subject->save();
            }
        }

        if($user->type == 3){
            return redirect()->route('users.index')->with('success', 'Student updated successfully.');
        }else{
            return redirect()->route('users.staff')->with('success', 'Staff updated successfully.');
        }
    }

    public function destroy(Request $request)
    {
        $user = User::find($request->data_id);
        if($user)
        {
            if($user->type == 3){
                $old_subjects = StudentSubject::where('student_id', $user->id)->delete();
                $user->delete();
                return redirect()->route('users.index')->with('delete', 'Student deleted successfully.');
            }else{
                $old_subjects = TeacherSubject::where('teacher_id', $user->id)->delete();
                $user->delete();
                return redirect()->route('users.staff')->with('delete', 'Staff deleted successfully.');
            }
        }
        else
        {
            return redirect()->route('users.index')->with('delete', 'No user found!.');
        }    
    }

    public function staff()
    {
        $staffs = User::where('type', '!=', 3)->orderBy('id', 'desc')->paginate(25);
        return view('users.staff', compact('staffs'));
    }

    public function create_staff()
    {
        return view('users.create_staff');
    }

    public function emailcheck(Request $request)
    {
        $email = $request->input("email");
        $success = false;
        $user = User::where('email', $email)->first();
        if($user == null){
            $success = true;
        }else{
            $success = false;
        }

        return response()->json([
            "success" => $success
        ]);
    }

    public function contactcheck(Request $request)
    {
        $contact = $request->input("contact");
        $success = false;
        $user = User::where('contact', $contact)->first();
        if($user == null){
            $success = true;
        }else{
            $success = false;
        }

        return response()->json([
            "success" => $success
        ]);
    }
}