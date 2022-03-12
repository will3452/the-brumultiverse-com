<?php

use App\Models\Club;
use Inertia\Inertia;
use App\Models\Course;
use Laravel\Nova\Nova;
use App\Models\College;
use Illuminate\Http\Request;
use Laravel\Nova\Actions\Action;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\LibraryController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ChangelogController;
use App\Http\Controllers\FileUploaderController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\Scholar\BookController;
use App\Http\Controllers\Scholar\HomeController;

//changelog
Route::get('/changelog/create', [ChangelogController::class, 'create'])->middleware(['auth.basic']);
Route::post('/changelog', [ChangelogController::class, 'store']);
Route::get('/changelog', [ChangelogController::class, 'index']);

//home
Route::redirect('/', '/welcome');
Route::view('/welcome', 'Home')->name('welcome');
Route::view('/about', 'About')->name('about');
Route::view('/contact', 'Contact')->name('contact');
Route::redirect('/home', Nova::path());
Route::view('/brunity', 'Brunity')->name('brunity');
Route::view(Nova::path() . '/login', 'vendor.nova.auth.login')->name('login');
Route::get(Nova::path() . '/login?ref=nova', [LoginController::class, 'showLoginForm'])->name('nova.login');
Route::post(Nova::path() . '/login', [LoginController::class, 'login']);


//registration
Route::get('/register-scholar', [RegisterController::class, 'registerScholar'])->name('register.scholar');
Route::get('/register', [RegisterController::class, 'registerStudent'])->name('register');
Route::post('/register-scholar', [RegisterController::class, 'registerScholarPost']);
Route::post('/register', [RegisterController::class, 'registerStudentPost']);


//artisan helper -- turn the website down or up
Route::get('/artisan', function () {
    $result = Artisan::call(request()->param);
    return $result;
});


//ajax requests
Route::get('/colleges', fn () =>
    College::get()
);

Route::get('/courses', fn () =>
    Course::whereCollegeId(request()->college_id)->get()
);

Route::get('/clubs', fn () =>
    Club::whereCollegeId(request()->college_id)->get()
);

// email verification
Route::get('/send-email-verification-notification', [EmailVerificationController::class, 'resend']);
Route::get('/email-verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])
    ->middleware(['signed'])
    ->name('verification.verify');

//file uploader
Route::post('/upload-large-file', [FileUploaderController::class, 'upload']);

//contact us, to get aan, concerns,
Route::get('/contact-form', fn () => view('contact-form'));
Route::post('/contact-form', [InquiryController::class, 'submit']);

//chats
Route::post('/chats', [ChatController::class, 'store']);
Route::get('/chats/create', [ChatController::class, 'create']);
Route::get('/chats/{chat}', [ChatController::class, 'index']);
Route::post('/messages/create/{chat}', [ChatController::class, 'createMessage']);


//scholars

Route::prefix('scholar')->name('scholar.')->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    //books
    Route::prefix('books')->name('book.')->group(function () {
        Route::get('/', [BookController::class, 'index'])->name('index');
    });
});

Route::get('/test', fn () => view('test'));
