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
use App\Http\Controllers\Scholar\BookController;
use App\Http\Controllers\Scholar\HomeController;
use App\Http\Controllers\Scholar\ChapterController;
use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\Scholar\ArtSceneController;
use App\Http\Controllers\Scholar\AudioBookController;
use App\Http\Controllers\Scholar\EventsController;
use App\Http\Controllers\Scholar\FilmController;
use App\Http\Controllers\Scholar\NotificationController;
use App\Http\Controllers\Scholar\PodcastController;
use App\Http\Controllers\Scholar\ProfileController;
use App\Http\Controllers\Scholar\SearchController;
use App\Http\Controllers\Scholar\SongController;

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

//chats
Route::post('/chats', [ChatController::class, 'store']);
Route::get('/chats/create', [ChatController::class, 'create']);
Route::get('/chats/{chat}', [ChatController::class, 'index']);
Route::post('/messages/create/{chat}', [ChatController::class, 'createMessage']);

//scholars

Route::prefix('scholar')->name('scholar.')->middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    //notifications
    Route::prefix('notifications')->name('notification.')->group(function () {
        Route::get('/', [NotificationController::class, 'index'])->name('index');
        Route::get('/mark-as-read/{id}', [NotificationController::class, 'markAsRead'])->name('mark-as-read');
    });

    //search
    Route::get('/search', [SearchController::class, 'search'])->name('search');

    Route::get('/logout', function () {
        auth()->logout();
        return redirect('/');
    })->name('logout');
    //profile
    Route::prefix('profiles')->name('profile.')->group(function () {
        Route::get('/{user}', [ProfileController::class, 'show'])->name('show');
        Route::put('/profile/{user}', [ProfileController::class, 'update'])->name('update');
        Route::post('/account', [ProfileController::class, 'registerAccount'])->name('account.register');
        Route::delete('/account/{account}', [ProfileController::class, 'removeAccount'])->name('account.delete');
        Route::put('profile-picture-update', [ProfileController::class, 'updatePicture'])->name('update.picture');
    });

    //books
    Route::prefix('books')->name('book.')->group(function () {
        //chapters
        Route::get('/{book}/chapters', [BookController::class, 'showChapters'])->name('chapters');
        Route::get('/', [BookController::class, 'index'])->name('index');
        Route::get('/create', [BookController::class, 'create'])->name('create');
        Route::post('/', [BookController::class, 'store'])->name('store');
        Route::get('/book/pdf/{book}', [BookController::class, 'pdfUploadForm'])->name('pdf');
        Route::put('/book/pdf/{book}', [BookController::class, 'pdfUploadFormStore']);
        Route::get('/{book}', [BookController::class, 'show'])->name('show');
        Route::put('/{book}', [BookController::class, 'update'])->name('update');
    });

    Route::prefix('chapters')->name('chapter.')->group(function () {
        Route::get('{book}/create', [ChapterController::class, 'create'])->name('create');
        Route::post('{book}/store', [ChapterController::class, 'store'])->name('store');
        Route::get('{chapter}', [ChapterController::class, 'show'])->name('show');
        Route::put('{chapter}', [ChapterController::class, 'update'])->name('update');
    });

    Route::prefix('audio-books')->name('audiobook.')->group(function () {
        Route::get('/', [AudioBookController::class, 'index'])->name('index');
        Route::get('/create', [AudioBookController::class, 'create'])->name('create');
        Route::post('/', [AudioBookController::class, 'store'])->name('store');
        Route::get('/{audio}', [AudioBookController::class, 'show'])->name('show');
        Route::put('/{audio}', [AudioBookController::class, 'update'])->name('update');
    });

    Route::prefix('art-scenes')->name('artscene.')->group(function () {
        Route::get('/', [ArtSceneController::class, 'index'])->name('index');
        Route::get('/create', [ArtSceneController::class, 'create'])->name('create');
        Route::post('/', [ArtSceneController::class, 'store'])->name('store');
        Route::get('/{art}', [ArtSceneController::class, 'show'])->name('show');
        Route::put('/{art}', [ArtSceneController::class, 'update'])->name('update');
    });

    Route::prefix('songs')->name('song.')->group(function () {
        Route::get('/', [SongController::class, 'index'])->name('index');
        Route::get('/create', [SongController::class, 'create'])->name('create');
        Route::post('/', [SongController::class, 'store'])->name('store');
        Route::get('/{song}', [SongController::class, 'show'])->name('show');
        Route::put('/{song}', [SongController::class, 'update'])->name('update');
    });

    Route::prefix('films')->name('film.')->group(function () {
        Route::get('/', [FilmController::class, 'index'])->name('index');
        Route::get('/create', [FilmController::class, 'create'])->name('create');
        Route::post('/', [FilmController::class, 'store'])->name('store');
        Route::get('/{film}', [FilmController::class, 'show'])->name('show');
        Route::put('/{film}', [FilmController::class, 'update'])->name('update');
    });

    Route::prefix('podcasts')->name('podcast.')->group(function () {
        Route::get('/', [PodcastController::class, 'index'])->name('index');
        Route::get('/create', [PodcastController::class, 'create'])->name('create');
        Route::post('/', [PodcastController::class, 'store'])->name('store');
        Route::get('/{podcast}', [PodcastController::class, 'show'])->name('show');
        Route::put('/{podcast}', [PodcastController::class, 'update'])->name('update');
    });

    Route::prefix('events')->name('event.')->group(function () {
        Route::get('/', [EventsController::class, 'index'])->name('index');
        Route::get('/create', [EventsController::class, 'create'])->name('create');
        Route::post('/', [EventsController::class, 'store'])->name('store');
        Route::get('/{event}', [EventsController::class, 'show'])->name('show');
        Route::put('/{event}', [EventsController::class, 'update'])->name('update');
        Route::post('/request-for-approval/{event}', [EventsController::class, 'requestForApproval'])->name('request-to-approve');
    });
});

Route::get('/test', fn () => 'hello world');
