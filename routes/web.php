<?php

use App\Http\Controllers\AvatarController;
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
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ChangelogController;
use App\Http\Controllers\FileUploaderController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\Scholar\BookController;
use App\Http\Controllers\Scholar\FilmController;
use App\Http\Controllers\Scholar\HomeController;
use App\Http\Controllers\Scholar\SongController;
use App\Http\Controllers\Developer\BugController;
use App\Http\Controllers\Scholar\AnnexController;
use App\Http\Controllers\Scholar\EventsController;
use App\Http\Controllers\Scholar\SearchController;
use App\Http\Controllers\Scholar\ChapterController;
use App\Http\Controllers\Scholar\MarqueeController;
use App\Http\Controllers\Scholar\PodcastController;
use App\Http\Controllers\Scholar\ProfileController;
use App\Http\Controllers\Scholar\ArtSceneController;
use App\Http\Controllers\Scholar\BulletinController;
use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\Scholar\AudioBookController;
use App\Http\Controllers\Scholar\MarketingController;
use App\Http\Controllers\Scholar\NewspaperController;
use App\Http\Controllers\Scholar\FreeArtSceneController;
use App\Http\Controllers\Scholar\GroupController;
use App\Http\Controllers\Scholar\LoadingImageController;
use App\Http\Controllers\Scholar\MessageBlastController;
use App\Http\Controllers\Scholar\NotificationController;
use App\Http\Controllers\Scholar\SlidingBannerController;
use App\Http\Controllers\Scholar\RequestToPublishController;
use App\Http\Controllers\Scholar\PaymentTransactionController;
use App\Http\Controllers\Scholar\LoginController as ScholarLoginController;
use App\Http\Controllers\Scholar\RegisterController as ScholarRegisterController;
use App\Http\Controllers\Scholar\TicketController;
use App\Http\Controllers\Student\PaymentController as StudentPaymentController;
use App\Http\Controllers\Student\RegisterController as StudentRegisterController;
use App\Http\Requests\StudentRegisterRequest;
use App\Models\Aan;

//changelog
Route::get('/changelog/create', [ChangelogController::class, 'create'])->middleware(['auth.basic']);
Route::post('/changelog', [ChangelogController::class, 'store']);
Route::get('/changelog', [ChangelogController::class, 'index']);

//home
Route::redirect('/', '/welcome');
Route::redirect('/login', '/scholar/login')->name('login');
Route::redirect('/home', '/scholar/home');

Route::view('/welcome', 'Home')->name('welcome');
Route::view('/about', 'About')->name('about');
Route::view('/contact', 'Contact')->name('contact');
Route::view('/brunity', 'Brunity')->name('brunity');
Route::view(Nova::path() . '/login', 'vendor.nova.auth.login');
Route::get(Nova::path() . '/login?ref=nova', [LoginController::class, 'showLoginForm'])->name('nova.login');
Route::post(Nova::path() . '/login', [LoginController::class, 'login']);

//scholar login
Route::prefix('scholar')->name('scholar.')->middleware(['guest'])->group(function () {
    Route::get('login', [ScholarLoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [ScholarLoginController::class, 'login']);
    Route::get('register', [ScholarRegisterController::class, 'showRegisterForm'])->name('register');
    Route::post('register', [ScholarRegisterController::class, 'register']);
});

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

    //tickets
    Route::prefix('tickets')->name('ticket.')->group(function () {
        Route::post('store-update-ticket', [TicketController::class, 'storeUpdateTicket'])->name('store-update');
    });

    //search
    Route::get('/search', [SearchController::class, 'search'])->name('search');

    Route::get('/logout', [ScholarLoginController::class, 'logout'])->name('logout');
    //profile
    Route::prefix('profiles')->name('profile.')->group(function () {
        Route::get('/{user}', [ProfileController::class, 'show'])->name('show');
        Route::put('/profile/{user}', [ProfileController::class, 'update'])->name('update');
        Route::post('/account', [ProfileController::class, 'registerAccount'])->name('account.register');
        Route::delete('/account/{account}', [ProfileController::class, 'removeAccount'])->name('account.delete');
        Route::put('/account-picture-update/{account}', [ProfileController::class, 'updateAccountPicture'])->name('account.picture.update');
        Route::put('profile-picture-update', [ProfileController::class, 'updatePicture'])->name('update.picture');
    });

    //books
    Route::prefix('books')->name('book.')->group(function () {
        //demo
        Route::get('demo/{book}', [BookController::class, 'showBookDemo'])->name('demo');
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

    //free art_scene
    Route::prefix('free')->name('free.')->group(function () {
        Route::post('art-scene', [FreeArtSceneController::class, 'addFreeArtScene'])
            ->name('art-scene');
    });

    //requests to publish works
    Route::prefix('requests')->name('request.')->group(function () {
        Route::post('publish-work', [RequestToPublishController::class, 'requestToPublish'])->name('publish');
    });

    //groups

    Route::prefix('groups')->name('group.')->group(function () {
        Route::post('/edit-position/{member}', [GroupController::class, 'editPosition'])->name('edit.position');
        Route::get('/', [GroupController::class, 'index'])->name('index');
        Route::get('/create', [GroupController::class, 'create'])->name('create');
        Route::post('/', [GroupController::class, 'store'])->name('store');
        Route::get('/{group}', [GroupController::class, 'show'])->name('show');
        Route::post('/new-member/{group}', [GroupController::class, 'addMember'])->name('add.member');
    });

    Route::prefix('events')->name('event.')->group(function () {
        Route::get('/', [EventsController::class, 'index'])->name('index');
        Route::get('/create', [EventsController::class, 'create'])->name('create');
        Route::post('/', [EventsController::class, 'store'])->name('store');
        Route::get('/{event}', [EventsController::class, 'show'])->name('show');
        Route::put('/{event}', [EventsController::class, 'update'])->name('update');
        Route::post('/request-for-approval/{event}', [EventsController::class, 'requestForApproval'])->name('request-to-approve');
    });

    Route::prefix('bulletins')->name('bulletin.')->group(function () {
        Route::get('/', [BulletinController::class, 'index'])->name('index');
        Route::get('/create', [BulletinController::class, 'create'])->name('create');
        Route::post('/', [BulletinController::class, 'store'])->name('store');
        Route::get('/{bulletin}', [BulletinController::class, 'show'])->name('show');
        Route::put('/{bulletin}', [BulletinController::class, 'update'])->name('update');
    });

    Route::prefix('newspapers')->name('newspaper.')->group(function () {
        Route::get('/', [NewspaperController::class, 'index'])->name('index');
        Route::get('/create', [NewspaperController::class, 'create'])->name('create');
        Route::post('/', [NewspaperController::class, 'store'])->name('store');
        Route::get('/{newspaper}', [NewspaperController::class, 'show'])->name('show');
        Route::put('/{newspaper}', [NewspaperController::class, 'update'])->name('update');
    });

    Route::prefix('marquees')->name('marquee.')->group(function () {
        Route::get('/', [MarqueeController::class, 'index'])->name('index');
        Route::get('/create', [MarqueeController::class, 'create'])->name('create');
        Route::post('/', [MarqueeController::class, 'store'])->name('store');
        Route::get('/{marquee}', [MarqueeController::class, 'show'])->name('show');
        Route::put('/{marquee}', [MarqueeController::class, 'update'])->name('update');
    });

    Route::prefix('loading-images')->name('loading-image.')->group(function () {
        Route::get('/', [LoadingImageController::class, 'index'])->name('index');
        Route::get('/create', [LoadingImageController::class, 'create'])->name('create');
        Route::post('/', [LoadingImageController::class, 'store'])->name('store');
        Route::get('/{loadingImage}', [LoadingImageController::class, 'show'])->name('show');
        Route::put('/{loadingImage}', [LoadingImageController::class, 'update'])->name('update');
    });

    Route::prefix('sliding-banners')->name('sliding-banner.')->group(function () {
        Route::get('/', [SlidingBannerController::class, 'index'])->name('index');
        Route::get('/create', [SlidingBannerController::class, 'create'])->name('create');
        Route::post('/', [SlidingBannerController::class, 'store'])->name('store');
        Route::get('/{slidingBanner}', [SlidingBannerController::class, 'show'])->name('show');
        Route::put('/{slidingBanner}', [SlidingBannerController::class, 'update'])->name('update');
    });

    Route::prefix('message-blasts')->name('message-blast.')->group(function () {
        Route::get('/', [MessageBlastController::class, 'index'])->name('index');
        Route::get('/create', [MessageBlastController::class, 'create'])->name('create');
        Route::post('/', [MessageBlastController::class, 'store'])->name('store');
        Route::get('/{messageBlast}', [MessageBlastController::class, 'show'])->name('show');
        Route::put('/{messageBlast}', [MessageBlastController::class, 'update'])->name('update');
    });

    // marketing save
    Route::prefix('marketings')->name('marketing.')->group(function () {
        Route::post('/save', [MarketingController::class, 'save'])->name('save');
    });

    Route::prefix('transactions')->name('transaction.')->group(function () {
        Route::get('/', [PaymentTransactionController::class, 'getAllTransactions'])->name('index');
    });
});

//students
Route::prefix('students')->name('student.')->group(function () {
    Route::get('/register', [StudentRegisterController::class, 'showRegister'])->name('register');
    Route::post('/register', [StudentRegisterController::class, 'register']);
    Route::get('/register-after', [StudentRegisterController::class, 'registerAfter'])->name('after.register');
    Route::post('/save-setup-account', [StudentRegisterController::class, 'saveAccount'])->name('save.account');
    Route::get('/welcome-dorm', [StudentRegisterController::class, 'welcomeToDorm'])->name('welcome.dorm');
    Route::get('/welcome-closet', [StudentRegisterController::class, 'welcomeToCloset'])->name('welcome.closet');
    Route::get('/avatar-saved', fn () => 'your avatar has been saved! this page is under development <a href="/scholar/logout">logout</a>');
    // subscription / tuition settlement process
    Route::get('/pay-tuition', [StudentPaymentController::class, 'payTuition'])->name('pay-tuition');
});

//misc
Route::get('get-annex', [AnnexController::class, 'getAnnex']);

//payment
Route::post('/create-payment', [PaymentController::class, 'createPayment']);
Route::get('/payment-result', [PaymentController::class, 'result']);


//bug submit
Route::post('/bug-submit', [BugController::class, 'store'])->name('submit.bug');

Route::view('/terms-and-conditions', 'tnc');
Route::view('/privacy-policy', 'pp');

//avatars

Route::get('avatars', [AvatarController::class, 'setup']);
Route::get('create-avatar', [AvatarController::class, 'create']);

Route::get('/test', fn()=>getAsset('avatars/masaru.png'));
Route::get('aan-generate', function () {
    return Aan::generate()->value;
});

//devs
Route::prefix('devs')->name('dev.')->group(function () {
    Route::get('bugs', [BugController::class, 'bugs']);
    Route::post('bugs/{bug}', [BugController::class, 'markAsFixed']);
});
