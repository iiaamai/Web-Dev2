<?php

use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/students');

Route::get('students/{student}/photo/create', [StudentController::class, 'createPhoto'])
	->name('students.photo.create');
Route::post('students/{student}/photo', [StudentController::class, 'storePhoto'])
	->name('students.photo.store');

Route::resource('students', StudentController::class);
