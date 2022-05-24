<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AvatarController;
use App\Http\Controllers\Student\ClosetController;
use App\Http\Controllers\Student\DormController;
use App\Http\Controllers\Student\LibraryController;
use App\Http\Controllers\Student\LoginController;
use App\Http\Controllers\Student\MapController;
use App\Http\Controllers\Student\MuseumController;
use App\Http\Controllers\Student\PaymentController;
use App\Http\Controllers\Student\RegisterController;

Route::get('/register', [RegisterController::class, 'showRegister'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::get('/register-after', [RegisterController::class, 'registerAfter'])->name('after.register');
Route::post('/save-setup-account', [RegisterController::class, 'saveAccount'])->name('save.account');
Route::get('/welcome-dorm', [RegisterController::class, 'welcomeToDorm'])->name('welcome.dorm');
Route::get('/welcome-closet', [RegisterController::class, 'welcomeToCloset'])->name('welcome.closet');
Route::get('/avatar-saved', [AvatarController::class, 'update']);

// login
Route::post('/login', [LoginController::class, 'login'])->name('login');

// subscription / tuition settlement process
Route::get('/pay-tuition', [PaymentController::class, 'payTuition'])->name('pay-tuition');
Route::get('/map-overview', [MapController::class, 'viewMap'])->name('map');

//dorm
Route::get('/dorm-tutorial', [DormController::class, 'tutorial'])->name('dorm.tutorial');
Route::prefix('dorm')->name('dorm.')->group(function () {
    Route::get('/', [DormController::class, 'myDorm'])->name('me');
});

//closet
Route::get('/closet-tutorial', [ClosetController::class, 'tutorial'])->name('closet.tutorial');


// library
Route::prefix('library')->name('library.')->group(function () {
    Route::get('/intro', [LibraryController::class, 'intro'])->name('intro');
    Route::get('/', [LibraryController::class, 'index'])->name('index');
    Route::get('/{work}', [LibraryController::class, 'show'])->name('show');
});

// museum
Route::prefix('museum')->name('museum.')->group(function () {
    Route::get('/', [MuseumController::class, 'index'])->name('index');
});
