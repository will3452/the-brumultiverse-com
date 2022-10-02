<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AvatarController;
use App\Http\Controllers\BagController;
use App\Http\Controllers\ReadingLogController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\Student\BookshelvesController;
use App\Http\Controllers\Student\BuyController;
use App\Http\Controllers\Student\ClosetController;
use App\Http\Controllers\Student\ComputerController;
use App\Http\Controllers\Student\DormController;
use App\Http\Controllers\Student\LibraryController;
use App\Http\Controllers\Student\LoginController;
use App\Http\Controllers\Student\MapController;
use App\Http\Controllers\Student\MuseumController;
use App\Http\Controllers\Student\NotificationController;
use App\Http\Controllers\Student\PaymentController;
use App\Http\Controllers\Student\PhoneController;
use App\Http\Controllers\Student\RegisterController;
use App\Http\Controllers\StudentAdminController;
use App\Http\Controllers\StudentChatController;
use App\Http\Controllers\StudentCollectionController;
use App\Http\Controllers\StudentDiaryController;

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
Route::get('/home', [MapController::class, 'viewMap'])->name('map');

//dorm
Route::get('/dorm-tutorial', [DormController::class, 'tutorial'])->name('dorm.tutorial');

Route::prefix('dorm')->name('dorm.')->group(function () {
    Route::get('/', [DormController::class, 'myDorm'])->name('me');
});

//closet
Route::get('/closet-tutorial', [ClosetController::class, 'tutorial'])->name('closet.tutorial');

Route::prefix('closets')->name('closet.')->group(function () {
    Route::get('/', [ClosetController::class, 'myCloset'])->name('me');
    Route::get('/mirror', [ClosetController::class, 'mirror'])->name('mirror');
    Route::get('/drawer', [ClosetController::class, 'drawer'])->name('drawer');
    Route::get('/save-avatar', [ClosetController::class, 'saveAvatar'])->name('save.avatar');
});


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

//admin
Route::prefix('admin-lobby')->name('admin.')->group(function () {
    Route::get('/', [StudentAdminController::class, 'index'])->name('index'); // lobby
    Route::get('/bulletin', [StudentAdminController::class, 'bulletin'])->name('bulletin');
});

//add to collections

Route::get('/add-to-collections/{type}/{id}', [StudentCollectionController::class, 'addToCollection'])->name('add.to.collection');
Route::get('/purchase-collections/{type}/{id}', [StudentCollectionController::class, 'purchaseCollection'])->name('purchase.collection');


Route::prefix('bookshelves')->name('bs.')->group(function () {
    Route::get('/', [BookshelvesController::class, 'index'])->name('index');
    Route::get('/block/{book}', [BookshelvesController::class, 'stopOver'])->name('block');
    Route::get('/read-book/{work}', [BookshelvesController::class, 'read'])->name('read');
    Route::get('/{work}', [BookshelvesController::class, 'show'])->name('show');
});

Route::prefix('phones')->name('phone.')->group(function () {
    Route::get('/', [PhoneController::class, 'index'])->name('index');
    Route::get('/images', [PhoneController::class, 'photo'])->name('photo');
    Route::get('/images/{path}', [PhoneController::class, 'viewPhoto'])->name('photo.view');
    Route::get('/contacts', [PhoneController::class, 'contactList'])->name('contact.list');
    Route::post('/contacts/{user}', [PhoneController::class, 'acceptFriendRequest'])->name('contact.accept');
});

Route::prefix('chat')->name('chat.')->group(function () {
    Route::get('/create', [StudentChatController::class, 'create'])->name('create');
    Route::post('/', [StudentChatController::class, 'store'])->name('store');
    Route::get('/{chat}', [StudentChatController::class, 'index'])->name('index');
    Route::post('/messages/chat/{chat}', [StudentChatController::class, 'createMessage'])->name('create.message');
});


Route::prefix('computer')->name('computer.')->group(function () {
    Route::get('/', [ComputerController::class, 'dashboard'])->name('dashboard');
    Route::get('/settings', [ComputerController::class, 'setting'])->name('setting');
    Route::get('/homework', [ComputerController::class, 'homework'])->name('homework');
    Route::get('/write-with-us', [ComputerController::class, 'writeWithUs'])->name('write');
});

Route::get('/exit', function () {
    auth()->logout();

    return redirect()->to('/');
})->name('exit');

Route::prefix('purchase')->name('buy.')->group(function () {
    Route::get('/crystal', [BuyController::class, 'crystals'])->name('crystal-old');
    Route::get('/purchase-crystal', [BuyController::class, 'purchaseCrystal'])->name('crystal');
    Route::post('/create-payment', [BuyController::class, 'createPayment'])->name('crystal.create.payment');
    Route::get('/payment-result', [BuyController::class, 'result'])->name('crystal.result.payment');
});

//reading logs
Route::prefix('/reading-logs')->name('readinglog.')->group(function () {
    Route::get('/save-log', [ReadingLogController::class, 'saveLog'])->name('save');
    Route::get('/check-log', [ReadingLogController::class, 'hasLog'])->name('check');
});


Route::prefix('/shop')->name('shop.')->group(function () {
    Route::get('/', [ShopController::class, 'index'])->name('index');
    Route::post('/proceed-to-buy', [ShopController::class, 'proceedToBuy'])->name('proceed.to.buy');
});

Route::prefix('/bag')->name('bag.')->group(function () {
    Route::get('/', [BagController::class, 'index'])->name('index');
});

//notifications
Route::prefix('/notifications')->name('notification.')->group(function () {
    Route::get('/', [NotificationController::class, 'index'])->name('index');
    Route::get('/mark-as-read/{id}', [NotificationController::class, 'markAsRead'])->name('mark-as-read');
});

Route::prefix('diaries')->name('diary.')->group(function () {
    Route::get('/', [StudentDiaryController::class, 'index'])->name('index');
    Route::post('/', [StudentDiaryController::class, 'store'])->name('store');
});
