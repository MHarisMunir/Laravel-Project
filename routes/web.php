<?php

use Illuminate\Support\Facades\Route;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Auth::routes(); //['verify' => true]

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::middleware(['auth'])->group(function(){  //,'verified'


    Route::get('/admin', [App\Http\Controllers\AdminsController::class, 'index'])->name('admin.index');

    Route::get('/post/{post}', [App\Http\Controllers\PostController::class, 'show'])->name('post');
    Route::get('/admin/posts/create', [App\Http\Controllers\PostController::class, 'create'])->name('post.create');
    Route::post('/admin/posts', [App\Http\Controllers\PostController::class, 'store'])->name('post.store');
    Route::get('/admin/posts', [App\Http\Controllers\PostController::class, 'index'])->name('posts.index');
    Route::delete('/admin/posts/{post}/destroy', [App\Http\Controllers\PostController::class, 'destroy'])->name('post.delete');
    Route::get('/admin/posts/{post}/edit', [App\Http\Controllers\PostController::class, 'edit'])->name('post.edit');
    Route::patch('/admin/posts/{post}/update', [App\Http\Controllers\PostController::class, 'update'])->name('post.update');

});
//another way to impose policy
//Route::get('/admin/posts/{post}/edit', [App\Http\Controllers\PostController::class, 'edit'])->middleware('can:view,$post')->name('post.edit');


// //1.    Email Verification Notice
// Route::get('/email/verify', function () {
//     return view('auth.verify');
// })->name('verification.notice');

//  //Route::get('/email/verify', [App\Http\Controllers\MailController::class, 'index'])->middleware('auth')->name('verification.notice');


// //2.    The Email Verification Handler
// Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
//     //return view('auth.login');
//     $request->fulfill();

//     //

//     return redirect('/admin');
// })->middleware(['auth', 'signed'])->name('verification.verify');

// //3.    Resending The Verification Email
// Route::post('/email/verification-notification', function (Request $request) {
//     $request->user()->sendEmailVerificationNotification();

//     return back()->with('message', 'Verification link sent!');
// })->middleware(['auth','throttle:6,1'])->name('verification.send');

// route::get('verifyNotice',function(){
//     return view('auth/verify');
// });

// route::get('/mail',function(){

// $data = [
//     'title' => 'Muhammad ',
//     'content' => 'Haris Munir'
// ];

// Mail::send('emails.test' , $data, function($message){

//     $message->to('harismunir0100@yahoo.com','Haris')->subject('Hello!');

// });

// });
////////////////////////////////////////////////

// Route::get('/verify','Auth\RegisterController@verifyUser')->name('verify.user');
// [App\Http\Controllers\MailController::class, 'index'];
Route::get('/verify','App\Http\Controllers\Auth\RegisterController@verifyUser')->name('verify.user');
