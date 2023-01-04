<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CourseController;
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


Auth::routes([
    'verify' => true
]);

Route::get('/users/list', [\App\Http\Controllers\UserController::class, 'index'])->name('users.index')->middleware('auth');
Route::delete('/users/{user}/delete', [\App\Http\Controllers\UserController::class, 'destroy'])->middleware('auth');

Route::get('/courses/list', [\App\Http\Controllers\CourseController::class, 'index'])->name('courses.index')->middleware('auth');
Route::get('/courses/create', [\App\Http\Controllers\CourseController::class, 'create'])->name('courses.create')->middleware('auth');
Route::post('/courses', [\App\Http\Controllers\CourseController::class, 'store'])->name('courses.store')->middleware('auth');
Route::delete('/courses/{course}/delete', [\App\Http\Controllers\CourseController::class, 'destroy'])->middleware('auth');
Route::get('/courses/edit/{course}', [\App\Http\Controllers\CourseController::class, 'edit'])->name('courses.edit')->middleware('auth');
Route::post('/courses/{course}', [\App\Http\Controllers\CourseController::class, 'update'])->name('courses.update')->middleware('auth');

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');
