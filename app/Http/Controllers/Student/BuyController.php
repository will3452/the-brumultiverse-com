<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Supports\PaymentSupport;
use App\Http\Controllers\Controller;
use App\Http\Controllers\PaymentController;
use App\Models\Balance;

class BuyController extends PaymentController
{
    public function crystals () {
        return view('student.buy.crystal');
    }

    public function result(Request $r)
    {

        toast('Transaction created you will receive a notification once it was done!');
        return redirect()->to(route('student.buy.crystal'));
    }

    public function createPayment(Request $r)
    {
        $prizes = [
            "hall_pass" =>12,
            "silver_ticket" => 15,
            "white_crystal" => 32,
            "purple_crystal" => 30,
        ];

        $amount = $r->quantity * $prizes[$r->type];
        $param = $this->createParam($amount, "Buy $r->type");

        session()->put('redirect', route('student.buy.crystal.result.payment'));
        $balanceId = auth()->user()->balance->id;
        $this->createTransaction('Balance', $balanceId, $param['txnid'], $amount, "$r->quantity-$r->type");

        $param = PaymentSupport::getDigestString($param);

        return redirect(PaymentSupport::getURL($param));
    }
}
