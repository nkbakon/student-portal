<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\StudentSubject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;
use Anhskohbo\NoCaptcha\Facades\NoCaptcha;

class AuthController extends Controller
{
    function login(){
        return view('auth.login');
    }

    function loginPost(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $usercheck = User::where('email', $request->email)->first();
        if(isset($usercheck)){
            if($usercheck->status == '1'){
                $credentials = $request->only('email', 'password');
                if(Auth::attempt($credentials)){
                    return redirect()->intended(route('dashboard'));
                }else{
                    return redirect()->route('login')->with('delete', 'Invalid email or password');
                }
            }
            else{
                return redirect()->route('login')->with('delete', 'Your account is deactivated, please contact Admin.');
            }
        }else{
            return redirect()->route('login')->with('delete', 'Invalid email or password');
        }        
        
    }

    function logout(){
        Session::flush();
        Auth::logout();
        return redirect()->route('login');
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:6|regex:/^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&#])[A-Za-z\d@$!%*?&#]{6,}$/',
            'confirm_password' => 'required|same:password',
        ]);

        if(Hash::check($request->current_password,$user->password)){
            $user->update([
                'password' => Hash::make($request->password)
            ]);

            return redirect()->route('profile.index')->with('success', 'Password updated successfully.');
        }else{
            return redirect()->route('profile.index')->with('err', 'Invalid current password.');            
        }        
    }

    public function forgot_password(){
        return view('auth.forgot_password');
    }

    public function forgotPasswordPost(Request $request){

        $request->validate([
            'email' => "required|email|exists:users",
        ]);

        DB::table('password_reset_tokens')
        ->where('email', $request->email)
        ->delete();

        $token = Str::random(64);

        DB::table('password_reset_tokens')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now(),
        ]);

        Mail::send("auth.fp_email", ['token' => $token, 'email' => $request->email], function ($message) use ($request){
            $message->to($request->email);
            $message->subject("Reset Password");
        });

        return redirect()->route('forgot_password')->with('status', 'Email sent to reset the password!.');
    }

    public function resetPassword($token, $email){
        return view('auth.new_password', compact('token', 'email'));
    }

    public function resetPasswordPost(Request $request){
        $request->validate([
            'email' => "required|email|exists:users",
            'password' => "required|string|min:6|regex:/^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&#])[A-Za-z\d@$!%*?&#]{6,}$/|confirmed",
            'password_confirmation' => "required|same:password",
        ]);

        $updatePassword = DB::table('password_reset_tokens')
        ->where([
            "email" => $request->email,
            "token" => $request->token,
        ])->first();

        if(!$updatePassword){
            return redirect()->route('login')->with('delete', 'Invalid data!.');
        }
        else{
            User::where('email', $request->email)->update(["password" => Hash::make($request->password)]);
            
            DB::table('password_reset_tokens')->where(["email" => $request->email])->delete();

            return redirect()->route('login');
        }
    }

    function register(){
        return view('auth.register');
    }

    public function register_store(Request $request)
    {
        if (!empty($request->input('website'))) {
            return redirect()->back()->with('delete', 'Bot detected!');
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'district' => 'required',
            'address' => 'required',
            'gender' => 'required',
            'contact' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|unique:users,contact',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|regex:/^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&#])[A-Za-z\d@$!%*?&#]{6,}$/',
            'confirm_password' => 'required|same:password',
            'g-recaptcha-response' => 'required',
        ]);

        $validator->after(function ($validator) use ($request) {
            if (! NoCaptcha::verifyResponse($request->input('g-recaptcha-response'))) {
                $validator->errors()->add('g-recaptcha-response', 'reCAPTCHA verification failed.');
            }
        });
        
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = new User();
        $user->name = $request->name;
        $user->contact = $request->contact;
        $user->email = $request->email;
        $user->district = $request->district;
        $user->address = $request->address;
        $user->type = 3;
        $user->parent_name = $request->parent_name;
        $user->parent_contact = $request->parent_contact;
        $user->parent_name2 = $request->parent_name2;
        $user->parent_contact2 = $request->parent_contact2;
        $user->exam = $request->exam;
        $user->dob = $request->dob;
        $user->gender = $request->gender;
        $user->password = Hash::make($request->password);
        $user->status = 3;
        $user->save();

        foreach($request->subjects as $subject){
            $picked_subject = new StudentSubject();
            $picked_subject->student_id = $user->id;
            $picked_subject->subject_id = $subject;
            $picked_subject->save();
        }

        if($user){
            return redirect()->route('register')->with('status', 'Registration Form Submitted Successfully.');
        }
        return redirect()->route('register')->with('delete', 'Registration Form Submit Faild, Try Again.');
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