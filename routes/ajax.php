<?php

use Illuminate\Support\Facades\Route;
use App\Models\Club;
use App\Models\Course;
use App\Models\College;

//ajax requests
Route::get('/colleges', fn () =>
    College::get()
)->name('college');

Route::get('/courses', fn () =>
    Course::whereCollegeId(request()->college_id)->get()
)->name('course');

Route::get('/clubs', fn () =>
    Club::whereCollegeId(request()->college_id)->get()
)->name('club');
