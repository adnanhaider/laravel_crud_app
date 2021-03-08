<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\CourseController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function(){
    return view('home');
})->name('home');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard'); //->middleware('auth'); // this is one way

Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login']);


Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);


Route::get('/students', [StudentController::class, 'index'])->name('students');
Route::post('/students', [StudentController::class, 'addStudent']);
Route::post('/updatestudent', [StudentController::class, 'updateStudent'])->name('updateStudent');
Route::get('/students/{id}', [StudentController::class, 'deleteStudent'])->name('deleteStudent');

Route::get('/teacher', [TeacherController::class, 'index'])->name('teachers');
Route::post('/teacher', [TeacherController::class, 'addTeacher']);
Route::post('/updateteacher', [TeacherController::class, 'updateTeacher'])->name('updateTeacher');
Route::get('/deleteteacher/{id}', [TeacherController::class, 'deleteTeacher'])->name('deleteTeacher');


Route::get('/courses', [CourseController::class, 'index'])->name('courses');
Route::post('/courses', [CourseController::class, 'addCourse']);
Route::get('/updateCourses', [CourseController::class, 'updateCourse'])->name('updateCourse');
Route::get('/course/{id}', [CourseController::class, 'deleteCourse'])->name('deleteCourse');
