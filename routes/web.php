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

/**
 * Użytkownicy
 */
Route::get('/users/list', [\App\Http\Controllers\UserController::class, 'index'])->name('users.index')->middleware('auth');
Route::delete('/users/{user}/delete', [\App\Http\Controllers\UserController::class, 'destroy'])->middleware('auth');
Route::get('/users/edit/{user}', [\App\Http\Controllers\UserController::class, 'edit'])->name('users.edit')->middleware('auth');
Route::post('/users/{user}', [\App\Http\Controllers\UserController::class, 'update'])->name('users.update')->middleware('auth');

/**
 * Kursy
 */
Route::get('/courses/list', [\App\Http\Controllers\CourseController::class, 'index'])->name('courses.index')->middleware('auth');
Route::get('/courses/create', [\App\Http\Controllers\CourseController::class, 'create'])->name('courses.create')->middleware('auth');
Route::post('/courses', [\App\Http\Controllers\CourseController::class, 'store'])->name('courses.store')->middleware('auth');
Route::delete('/courses/{course}/delete', [\App\Http\Controllers\CourseController::class, 'destroy'])->middleware('auth');
Route::get('/courses/edit/{course}', [\App\Http\Controllers\CourseController::class, 'edit'])->name('courses.edit')->middleware('auth');
Route::post('/courses/{course}', [\App\Http\Controllers\CourseController::class, 'update'])->name('courses.update')->middleware('auth');

/**
 * Lekcje ADMIN
 */
Route::get('/courses/lessons/index/{course}', [\App\Http\Controllers\LessonController::class, 'index'])->name('courses.lessons.index')->middleware('auth');
Route::get('/courses/lessons/{course}/create', [\App\Http\Controllers\LessonController::class, 'create'])->name('courses.lessons.create')->middleware('auth');
Route::post('/lessons/{course}', [\App\Http\Controllers\LessonController::class, 'store'])->name('courses.lessons.store')->middleware('auth');
Route::delete('/lessons/{lesson}/delete', [\App\Http\Controllers\LessonController::class, 'destroy'])->middleware('auth');
Route::get('/lessons/edit/{lesson}', [\App\Http\Controllers\LessonController::class, 'edit'])->name('courses.lessons.edit')->middleware('auth');
Route::post('/lessons/update/{lesson}', [\App\Http\Controllers\LessonController::class, 'update'])->name('courses.lessons.update')->middleware('auth');
/**
 * Lekcje USER
 */
Route::get('/lesson/{lesson}', [\App\Http\Controllers\LessonController::class, 'userView'])->name('lessons.userView')->middleware('auth');
Route::get('/lesson/downloadFiles/{lesson}', [\App\Http\Controllers\LessonController::class, 'downloadFile'])->name('downloadFile')->middleware('auth');
Route::post('/lesson/{lesson}', [\App\Http\Controllers\LessonController::class, 'updateScore'])->name('updateScore')->middleware('auth');
/**
 * Home
 */
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');
