<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\AuthController;
use \App\Http\Controllers\ClassController;
use \App\Http\Controllers\SubjectController;
use \App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginPost'])->name('login.post');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::get('/register/phone/check', [AuthController::class, 'phonecheck'])->name('register.phonecheck');
Route::post('/register/store', [AuthController::class, 'register_store'])->name('register.store');
Route::get('/register/email/check', [AuthController::class, 'emailcheck'])->name('site.emailcheck');

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
Route::put('classes/{class}/view/assign', [ClassController::class, 'assign'])->name('classes.assign');
Route::delete('classes/{class}/view/assign/destroy', [ClassController::class, 'destroyAssign'])->name('classes.destroyAssign');

Route::get('classes/{class}/view_assignment', [ClassController::class, 'viewAssignment'])->name('classes.view_assignment');
Route::get('classes/{class}/view/assignment', [ClassController::class, 'assignment'])->name('classes.assignment');
Route::put('classes/{class}/view/assignment', [ClassController::class, 'storeAssignment'])->name('classes.assignment_store');

Route::get('subjects', [SubjectController::class, 'index'])->name('subjects.index');
Route::post('subjects/store', [SubjectController::class, 'store'])->name('subjects.store'); 
Route::put('subjects/update', [SubjectController::class, 'update'])->name('subjects.update');
Route::delete('subjects/destroy', [SubjectController::class, 'destroy'])->name('subjects.destroy');

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
