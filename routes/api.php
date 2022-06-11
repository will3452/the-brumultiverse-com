<?php

use App\Http\Controllers\ApiAuthenticationController;
use App\Http\Controllers\AvatarController;
use App\Http\Controllers\Scholar\BookContentController;
use App\Models\Account;
use App\Models\BookContent;
use App\Models\PaymentTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/dragonpay-postback', function (Request $request) {
     $transaction = PaymentTransaction::whereTxnid($request->txnid)->first();
     if ($transaction) {
        $transaction->update([
            'message' => $request->message,
            'ref_no' => $request->refno,
            'status' => PaymentTransaction::STATUSES[$request->status],
        ]);
    }
     return 'result=OK';
});

//private access
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/auth-test', function () {
        return 'authentication test';
    });
    Route::post('/logout', [ApiAuthenticationController::class, 'logout']);
});

Route::get('/public-test', function () {
    return 'public test';
});


//user authentication
Route::post('/register', [ApiAuthenticationController::class, 'register']);
Route::post('/login', [ApiAuthenticationController::class, 'login']);

Route::post('/account-exists', function (Request $request) {
    // this will check if the account given is valid
    return Account::wherePenname($request->penname)->exists();
});


//avatars api
Route::get('/avatars', [AvatarController::class, 'apiGet']);


# scholar
//book content chapter
Route::post('/book-content-chapter/edit/{chapter}', [BookContentController::class, 'editChapter']);
Route::post('/book-content-chapter', [BookContentController::class, 'addChapter']);
Route::get('/book-content-chapter/{book}', [BookContentController::class, 'getChapter']);
