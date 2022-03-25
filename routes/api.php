<?php

use App\Http\Controllers\ApiAuthenticationController;
use App\Models\PaymentTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('/dragonpay-postback', function (Request $request) {
     $transaction = PaymentTransaction::whereTxnid($request->txnid)->first();
     $transaction->update(['status' => PaymentTransaction::STATUSES[$request->status]]);
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
