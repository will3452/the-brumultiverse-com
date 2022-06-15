<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AvatarController;
use App\Http\Controllers\Student\BookshelvesController;
use App\Http\Controllers\Student\ClosetController;
use App\Http\Controllers\Student\DormController;
use App\Http\Controllers\Student\LibraryController;
use App\Http\Controllers\Student\LoginController;
use App\Http\Controllers\Student\MapController;
use App\Http\Controllers\Student\MuseumController;
use App\Http\Controllers\Student\PaymentController;
use App\Http\Controllers\Student\PhoneController;
use App\Http\Controllers\Student\RegisterController;
use App\Http\Controllers\StudentCollectionController;

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
    Route::get('/intro', [MuseumController::class, 'intro'])->name('intro');
    Route::get('/', [MuseumController::class, 'index'])->name('index');
    Route::get('/{work}', [MuseumController::class, 'show'])->name('show');
});

//add to collections

Route::get('/add-to-collections/{type}/{id}', [StudentCollectionController::class, 'addToCollection'])->name('add.to.collection');


Route::prefix('bookshelves')->name('bs.')->group(function () {
    Route::get('/', [BookshelvesController::class, 'index'])->name('index');
    Route::get('/read-book/{work}', [BookshelvesController::class, 'read'])->name('read');
    Route::get('/{work}', [BookshelvesController::class, 'show'])->name('show');
});

Route::prefix('phones')->name('phone.')->group(function () {
    Route::get('/', [PhoneController::class, 'index'])->name('index');
    Route::get('/images', [PhoneController::class, 'photo'])->name('photo');
    Route::get('/images/{path}', [PhoneController::class, 'viewPhoto'])->name('photo.view');
});
