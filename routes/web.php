<?php

use App\Http\Controllers\ContactsController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SocialiteController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;


Route::get('/',[LoginController::class,'index']);

Route::post('/register', [UsersController::class,'store'])->name('users.store');

Route::get('/login', [LoginController::class,'index'])->name('login');

Route::post('/login/store',[LoginController::class,'store'])->name('login.store');

Route::get('/login/{provider}', [SocialiteController::class,'provider'])->name('login.provider');
 
Route::get('/login/{provider}/callback',[SocialiteController::class,'providerCallback'])->name('login.callback');

Route::get('/forgot-password',[ForgotPasswordController::class,'passwordPutEmailReset'])->name('password.request');

Route::get('/reset-password/{token}',[ForgotPasswordController::class,'forgotPassword'])->name('password.reset');

Route::post('/forgot-password', [ForgotPasswordController::class,'passwordSendResetLink'])->name('password.email');

Route::post('/reset-password',[ForgotPasswordController::class,'resetPassword'])->name('password.update');


Route::middleware('auth')->group(function () {

    Route::get('/logout', [LoginController::class,'destroy'])->name('logout');

    Route::get('/contacts', [ContactsController::class,'index'])->name('contacts.index');

    Route::post('/contacts/store', [ContactsController::class,'store'])->name('contacts.store');

    Route::get('/contacts/create', [ContactsController::class,'create'])->name('contacts.create');

    Route::delete('/contacts/destroy/{id}', [ContactsController::class,'destroy'])->name('contacts.destroy');

    Route::get('/contacts/edit/{id}', [ContactsController::class,'edit'])->name('contacts.edit');

    Route::put('/contacts/update/{id}', [ContactsController::class,'update'])->name('contacts.update');

    Route::get('/events', [EventsController::class,'index'])->name('events.index');

    Route::post('/events/store', [EventsController::class,'store'])->name('events.store');

    Route::put('/events/update', [EventsController::class,'update'])->name('events.update');

});
