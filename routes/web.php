<?php

use Laravel\Nova\Nova;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\Chat1Controller;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AvatarController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\FileUploaderController;
use App\Http\Controllers\Scholar\AnnexController;
use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\QuoteMakerController;

//home & static
Route::view('/landing-business', 'landing-business'); // new
Route::redirect('/', '/welcome');
Route::redirect('/login', '/scholars/login')->name('login');
Route::redirect('/home', '/scholars/home');
Route::view('/welcome', 'Home')->name('welcome');
Route::view('/about', 'About')->name('about');
Route::get('/contact', function (Request $request) {
    $accessByComputer = $request->hidenav;
    return view('Contact', compact('accessByComputer'));
})->name('contact');
Route::view('/brunity', 'Brunity')->name('brunity');


// nova
Route::view(Nova::path() . '/login', 'vendor.nova.auth.login');
Route::get(Nova::path() . '/login?ref=nova', [LoginController::class, 'showLoginForm'])->name('nova.login');
Route::post(Nova::path() . '/login', [LoginController::class, 'login']);


// email verification
Route::view('/verify-email-first', 'verify-email-first');
Route::get('/send-email-verification-notification', [EmailVerificationController::class, 'resend']);
Route::get('/email-verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])
    ->middleware(['signed'])
    ->name('verification.verify');

//file uploader
Route::post('/upload-large-file', [FileUploaderController::class, 'upload']);
Route::post('/filepond-process', [FileUploaderController::class, 'filePond']);
Route::patch('/filepond-patch', [FileUploaderController::class, 'filePondUpdate']);
Route::delete('/filepond-revert', [FileUploaderController::class, 'filePondRevert']);

//contact us, to get aan, concerns,
Route::get('/contact-form', fn () => view('contact-form'));
Route::post('/contact-form', [InquiryController::class, 'submit']);

//old chats admin supported
Route::post('/chats', [ChatController::class, 'store']);
Route::get('/chats/create', [ChatController::class, 'create']);
Route::get('/chats/{chat}', [ChatController::class, 'index']);
Route::post('/messages/create/{chat}', [ChatController::class, 'createMessage']);

//new chat interface for scholars and students
Route::get('/chats-1/create', [Chat1Controller::class, 'create'])->name('chat.1.create');
Route::post('/chats-1', [Chat1Controller::class, 'store'])->name('chat.1.store');
Route::get('/chats-1/{chat}', [Chat1Controller::class, 'index'])->name('chat.1.index');
Route::post('/messages/create-1/{chat}', [Chat1Controller::class, 'createMessage'])->name('chat.1.create.message');
//misc
Route::get('get-annex', [AnnexController::class, 'getAnnex']);
Route::view('/terms-and-conditions', 'tnc');
Route::view('/privacy-policy', 'pp');

//payment
Route::post('/create-payment', [PaymentController::class, 'createPayment']);
Route::get('/payment-result', [PaymentController::class, 'result']);


//avatars
Route::get('avatars', [AvatarController::class, 'setup']);
Route::get('create-avatar', [AvatarController::class, 'create']);
Route::view('play', 'play');

//comments
Route::post('comments', [CommentController::class, 'submitComment'])->name('comment');

// quotes
Route::get('quotes-maker', [QuoteMakerController::class, 'makeQuote'])->name('make.quote');
