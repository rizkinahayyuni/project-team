<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    // return view('home');
    return redirect()->route('home.index');
});

Route::resource('/home', \App\Http\Controllers\HomeController::class);
Route::resource('/users', \App\Http\Controllers\UserController::class);
Route::resource('/projects', \App\Http\Controllers\ProjectController::class);
Route::resource('/attendance_list', \App\Http\Controllers\AttendanceListController::class);