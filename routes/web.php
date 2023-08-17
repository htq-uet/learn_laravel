<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});
//
//Route:: get ('/home', function () {
//    $user = new User();
////    $user->name = 'John Doe';
////    $user->email = 'gmail.com';
////    $user->password = 'password';
////    $user->save();
//    $allUsers = User::all();
//    dd($allUsers);
////    return view('laravel', ['title' => 'Laravel 8']);
//})->name('home');
//
//Route::get('greeting/', [\App\Http\Controllers\GreetingController::class, 'greet']);


Route::post('/register', function () {
    return "Hello World";
})->name('register');

Route::get('/register', function () {
    return view('form');
})->name('register');
