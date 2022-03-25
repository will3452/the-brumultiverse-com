<?php

namespace App\Http\Controllers\Scholar;

use App\Http\Controllers\Controller;
use App\Models\PaymentTransaction;
use Illuminate\Http\Request;

class PaymentTransactionController extends Controller
{
    public function getAllTransactions()
    {
        $transactions = PaymentTransaction::whereUserId(auth()->id())->latest()->get();
        return view('scholar.transactions', compact('transactions'));
    }
}
