<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\AssignmnetController;
use \App\Http\Controllers\AuthController;
use \App\Http\Controllers\CashOutController;
use \App\Http\Controllers\ClassController;
use \App\Http\Controllers\PaymentController;
use \App\Http\Controllers\SubjectController;
use \App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginPost'])->name('login.post');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/forgot_password', [AuthController::class, 'forgot_password'])->name('forgot_password');
Route::post('/forgot_password', [AuthController::class, 'forgotPasswordPost'])->name('password.post');
Route::get('/reset_password/{token}/{email}', [AuthController::class, 'resetPassword'])->name('password.recovery');
Route::post('/reset_password', [AuthController::class, 'resetPasswordPost'])->name('password.resetpost');

Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::get('/register/contact/check', [AuthController::class, 'contactcheck'])->name('register.contactcheck');
Route::post('/register/store', [AuthController::class, 'register_store'])->name('register.store');
Route::get('/register/email/check', [AuthController::class, 'emailcheck'])->name('site.emailcheck');

Route::group(['middleware' => ['auth']], function() {
    
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('classes', [ClassController::class, 'index'])->name('classes.index'); 
    Route::get('classes/create', [ClassController::class, 'create'])->name('classes.create');
    Route::post('classes/store', [ClassController::class, 'store'])->name('classes.store');
    Route::get('classes/{class}/edit', [ClassController::class, 'edit'])->name('classes.edit');
    Route::put('classes/{class}/update', [ClassController::class, 'update'])->name('classes.update');
    Route::delete('classes/destroy', [ClassController::class, 'destroy'])->name('classes.destroy');
    Route::get('classes/{class}/view', [ClassController::class, 'view'])->name('classes.view');

    Route::get('/get-subjects-by-teacher/{teacherId}', [ClassController::class, 'getSubjectsByTeacher']);

    Route::put('classes/{class}/view/assign', [ClassController::class, 'assign'])->name('classes.assign');
    Route::delete('classes/{class}/view/assign/destroy', [ClassController::class, 'destroyAssign'])->name('classes.destroyAssign');
    Route::get('classes/{assign}/view_assign', [ClassController::class, 'viewAssign'])->name('classes.viewAssign');

    Route::get('classes/{class}/view_assignment', [ClassController::class, 'viewAssignment'])->name('classes.view_assignment');
    Route::get('classes/{class}/view/assignment', [ClassController::class, 'assignment'])->name('classes.assignment');
    Route::put('classes/{class}/view/assignment', [ClassController::class, 'storeAssignment'])->name('classes.assignment_store');
    Route::get('classes/{assignment}/edit_assignment', [ClassController::class, 'edit_assignment'])->name('classes.edit_assignment');
    Route::put('classes/{assignment}/update_assignment', [ClassController::class, 'update_assignment'])->name('classes.update_assignment');
    Route::delete('classes/{class}/view/assignment/destroy', [ClassController::class, 'destroyAssignment'])->name('classes.destroyAssignment');

    Route::get('classes/{assignment}/submission', [ClassController::class, 'submission'])->name('classes.submission');
    Route::put('classes/{my_submission}/store_submission', [ClassController::class, 'storeSubmission'])->name('classes.storeSubmission');
    Route::get('classes/{student_assignment}/viewSubmission', [ClassController::class, 'viewSubmission'])->name('classes.viewSubmission');
    Route::delete('classes/{assignment}/submission/destroy', [ClassController::class, 'destroySubmission'])->name('classes.destroySubmission');
    Route::put('classes/{student_assignment}/check_submission', [ClassController::class, 'checkSubmission'])->name('classes.checkSubmission');

    Route::get('subjects', [SubjectController::class, 'index'])->name('subjects.index');
    Route::post('subjects/store', [SubjectController::class, 'store'])->name('subjects.store'); 
    Route::put('subjects/update', [SubjectController::class, 'update'])->name('subjects.update');
    Route::delete('subjects/destroy', [SubjectController::class, 'destroy'])->name('subjects.destroy');

    Route::get('payments', [PaymentController::class, 'index'])->name('payments.index');
    Route::get('payments/create', [PaymentController::class, 'create'])->name('payments.create');
    Route::post('payments/store', [PaymentController::class, 'store'])->name('payments.store');
    Route::get('payments/{payment}/edit', [PaymentController::class, 'edit'])->name('payments.edit');
    Route::put('payments/{payment}/update', [PaymentController::class, 'update'])->name('payments.update');
    Route::delete('payments/destroy', [PaymentController::class, 'destroy'])->name('payments.destroy');
    Route::get('payments/{payment}/view', [PaymentController::class, 'view'])->name('payments.view');

    Route::get('cashouts', [CashOutController::class, 'index'])->name('cashouts.index');
    Route::get('cashouts/create', [CashOutController::class, 'create'])->name('cashouts.create');
    Route::post('cashouts/store', [CashOutController::class, 'store'])->name('cashouts.store');
    Route::get('cashouts/{cashout}/edit', [CashOutController::class, 'edit'])->name('cashouts.edit');
    Route::put('cashouts/{cashout}/update', [CashOutController::class, 'update'])->name('cashouts.update');
    Route::delete('cashouts/destroy', [CashOutController::class, 'destroy'])->name('cashouts.destroy');
    Route::get('cashouts/{cashout}/view', [CashOutController::class, 'view'])->name('cashouts.view');

    Route::get('assignments', [AssignmnetController::class, 'index'])->name('assignments.index');

    Route::get('users/create/students', [UserController::class, 'create'])->name('users.create');
    Route::get('users/create/staff', [UserController::class, 'create_staff'])->name('users.create_staff');
    Route::post('users/store', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/email/check', [UserController::class, 'emailcheck'])->name('users.emailcheck');
    Route::get('/users/contact/check', [UserController::class, 'contactcheck'])->name('users.contactcheck');
    Route::get('users/students', [UserController::class, 'index'])->name('users.index'); 
    Route::get('users/staff', [UserController::class, 'staff'])->name('users.staff');        
    Route::get('users/edit/{user}/students', [UserController::class, 'edit'])->name('users.edit');
    Route::put('users/update/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('users/destroy', [UserController::class, 'destroy'])->name('users.destroy');

    Route::get('/profile', function () {
        return view('profile.index');
    })->name('profile.index');
    Route::put('/profile', [AuthController::class, 'update'])->name('password.update');

});
