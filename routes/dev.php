<?php

use App\Models\Aan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\Developer\BugController;

//artisan helper -- turn the website down or up
Route::get('/artisan', function () {
    $result = Artisan::call(request()->param);
    return $result;
});

// bugs helper
Route::post('/bug-submit', [BugController::class, 'store'])->name('submit.bug');
Route::get('bugs', [BugController::class, 'bugs']);
Route::post('bugs/{bug}', [BugController::class, 'markAsFixed']);

// download avatar helper
Route::get('download-avatar', [BugController::class, 'downloadAssets'])->name('avatar.asset');

// aan helper
Route::get('aan-generate', function () {
    return Aan::generate()->value;
});

Route::get('blank', function (Request $request) {
    return "underdevelopment $request->name";
})->name('blank');
