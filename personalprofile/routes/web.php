<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('profile');
});

Route::get('/profile', function () {
    return view('profile');
})->name('profile');

Route::get('/education', function () {
    return view('education');
})->name('education');

Route::get('/subjects', function () {
    return view('subjects');
})->name('subjects');
