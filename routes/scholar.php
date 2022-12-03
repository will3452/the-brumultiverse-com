<?php

use App\Http\Controllers\Scholar\GroupController;
use App\Http\Controllers\Scholar\EventsController;
use App\Http\Controllers\Scholar\SearchController;
use App\Http\Controllers\Scholar\SeriesController;
use App\Http\Controllers\Scholar\TicketController;
use App\Http\Controllers\Scholar\ChapterController;
use App\Http\Controllers\Scholar\MarqueeController;
use App\Http\Controllers\Scholar\PodcastController;
use App\Http\Controllers\Scholar\ProfileController;
use App\Http\Controllers\Scholar\ArtSceneController;
use App\Http\Controllers\Scholar\BulletinController;
use App\Http\Controllers\Scholar\AudioBookController;
use App\Http\Controllers\Scholar\BannerController;
use App\Http\Controllers\Scholar\MarketingController;
use App\Http\Controllers\Scholar\NewspaperController;
use App\Http\Controllers\Scholar\CollectionController;
use App\Http\Controllers\Scholar\FreeArtSceneController;
use App\Http\Controllers\Scholar\LoadingImageController;
use App\Http\Controllers\Scholar\MessageBlastController;
use App\Http\Controllers\Scholar\NotificationController;
use App\Http\Controllers\Scholar\SlidingBannerController;
use App\Http\Controllers\Scholar\RequestToPublishController;
use App\Http\Controllers\Scholar\PaymentTransactionController;
use App\Http\Controllers\Scholar\PreviewController;
use App\Http\Controllers\Scholar\PrologueEpilogueController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\Scholar\AlbumController;
use App\Http\Controllers\Scholar\BookContentController;
use App\Http\Controllers\Scholar\BookController;
use App\Http\Controllers\Scholar\FilmController;
use App\Http\Controllers\Scholar\HomeController;
use App\Http\Controllers\Scholar\SongController;
use App\Http\Controllers\Scholar\WorkController;
use App\Http\Controllers\Scholar\RegisterController as ScholarRegisterController;
use App\Http\Controllers\Scholar\LoginController as ScholarLoginController;
use Illuminate\Support\Facades\Route;

//guest mode

Route::middleware(['guest'])->group(function () {
    Route::get('login', [ScholarLoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [ScholarLoginController::class, 'login']);
    Route::get('register', [ScholarRegisterController::class, 'showRegisterForm'])->name('register');
    Route::post('register', [ScholarRegisterController::class, 'register']);
});

// auth mode
Route::middleware(['auth'])->group(function () {
    // preview
    Route::post('/preview', [PreviewController::class, 'upload'])->name('upload.preview');

    // scholar tools
    Route::get('/banner-editor', [BannerController::class, 'index'])->name('banner.editor');
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

    # DEPRECATED

    //prologue
    Route::prefix('prologue')->name('prologue.')->group(function () {
        Route::get('/{prologue}', [PrologueEpilogueController::class, 'showPrologue'])->name('show');
        Route::put('/{prologue}', [PrologueEpilogueController::class, 'updatePrologue'])->name('update');
    });

    //epilogue
    Route::prefix('epilogue')->name('epilogue.')->group(function () {
        Route::get('/{epilogue}', [PrologueEpilogueController::class, 'showEpilogue'])->name('show');
        Route::put('/{epilogue}', [PrologueEpilogueController::class, 'updateEpilogue'])->name('update');
    });

    #END OF DEPRECATED

    //books
    Route::prefix('books')->name('book.')->group(function () {
        //epilogue & prologue
        Route::post('/prologue/{book}', [BookController::class, 'prologue'])->name('prologue');
        Route::post('/epilogue/{book}', [BookController::class, 'epilogue'])->name('epilogue');
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

    Route::prefix('book-content')->name('book-content.')->group(function () {
        Route::get('{book}/preview', [BookContentController::class, 'preview'])->name('preview');
        Route::get('{book}/create', [BookContentController::class, 'create'])->name('create');
        Route::post('store', [BookContentController::class, 'store'])->name('store');
        Route::get('{book}/content-setting', [BookContentController::class, 'setting'])->name('setting');
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
        Route::post('/edit-commission/{member}', [GroupController::class, 'editCommission'])->name('edit.commission');
        Route::post('/edit-position/{member}', [GroupController::class, 'editPosition'])->name('edit.position');
        Route::get('/', [GroupController::class, 'index'])->name('index');
        Route::get('/create', [GroupController::class, 'create'])->name('create');
        Route::post('/', [GroupController::class, 'store'])->name('store');
        Route::get('/invitation', [GroupController::class, 'invitationGet'])->name('invitation');
        Route::post('/invitation/{invitation}', [GroupController::class, 'acceptInvitation'])->name('invitation.accept');
        Route::get('/{group}', [GroupController::class, 'show'])->name('show');
        Route::post('/new-member/{group}', [GroupController::class, 'addMember'])->name('add.member');
    });

    Route::prefix('albums')->name('album.')->group(function () {
        Route::get('/', [AlbumController::class, 'index'])->name('index');
        Route::get('/create', [AlbumController::class, 'create'])->name('create');
        Route::get('/{album}', [AlbumController::class, 'show'])->name('show');
        Route::post('/', [AlbumController::class, 'store'])->name('store');
    });

    Route::prefix('collections')->name('collection.')->group(function () {
        Route::get('/', [CollectionController::class, 'index'])->name('index');
        Route::get('/create', [CollectionController::class, 'create'])->name('create');
        Route::get('/{collection}', [CollectionController::class, 'show'])->name('show');
        Route::post('/', [CollectionController::class, 'store'])->name('store');
    });

    Route::prefix('series')->name('series.')->group(function () {
        Route::get('/', [SeriesController::class, 'index'])->name('index');
        Route::get('/create', [SeriesController::class, 'create'])->name('create');
        Route::get('/{series}', [SeriesController::class, 'show'])->name('show');
        Route::post('/', [SeriesController::class, 'store'])->name('store');
    });


    //especial route for adding of work for collection, albums and series
    Route::post('add-work', [WorkController::class, 'addWork'])->name('add.work');

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
