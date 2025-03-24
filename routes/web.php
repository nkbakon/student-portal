<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\AuthController;
use \App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginPost'])->name('login.post');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

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
