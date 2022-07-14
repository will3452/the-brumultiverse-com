<?php

use App\Models\Account;
use App\Models\BookContent;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PaymentTransaction;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AvatarController;
use App\Http\Controllers\ApiAuthenticationController;
use App\Http\Controllers\Scholar\BookContentController;

Route::post('/dragonpay-postback', function (Request $request) {
     $transaction = PaymentTransaction::whereTxnid($request->txnid)->first();
     if ($transaction) {
        $transaction->update([
            'message' => $request->message,
            'ref_no' => $request->refno,
            'status' => PaymentTransaction::STATUSES[$request->status],
        ]);

        if ($transaction->model_type === "App\\Models\\Balance" ) {
            if (Str::contains($transaction->description, 'package')) {
                $payloads = payloadDecode($transaction->payload);
                foreach ($payloads as $key => $value) {
                    $newVal = $transaction->model[$key] + $value;
                    $transaction->model()->update([$key => $newVal]); // update balance here
                }
            } else {
                $descriptionArr = explode("-", $transaction->description);
                $newBal = $transaction->model[$descriptionArr[1]] + $descriptionArr[0];
                $data[$descriptionArr[1]] = $newBal;
                $transaction->model()->update($data); // update the balance
            }
        }
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
Route::get('/user/{id}/avatar-get', [AvatarController::class, 'getMyAvatar']);


# scholar
//book content chapter
Route::post('/book-content-chapter/edit/{chapter}', [BookContentController::class, 'editChapter']);
Route::post('/book-content-chapter', [BookContentController::class, 'addChapter']);
Route::get('/book-content-chapter/{book}', [BookContentController::class, 'getChapter']);


//students
