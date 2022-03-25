<?php

namespace App\Http\Controllers;

use App\Models\PaymentTransaction;
use App\Notifications\PaymentNotification;
use Illuminate\Http\Request;
use App\Supports\PaymentSupport;
use Faker\Provider\ar_EG\Payment;

class PaymentController extends Controller
{
    public function customValidate($request)
    {
        $request->validate([
            'amount' => 'required',
            'description' => 'required',
        ]);
    }

    public function createTransaction($type, $id, $txnid, $amount, $description)
    {
        ("\\App\\Models\\$type")::findOrFail($id)->transactions()->create([
            'user_id' => auth()->id(),
            'amount' => $amount,
            'txnid' => $txnid,
            'description' => $description,
        ]);
    }


    public function createPayment(Request $r)
    {
        $param = PaymentSupport::createParameters(
            $r->amount,
            config('payment.ccy'),
            $r->description,
            config('payment.merchant_email')
        );

        $this->createTransaction($r->type, $r->id, $param['txnid'], $r->amount, $r->description);

        $param = PaymentSupport::getDigestString($param);

        return redirect(PaymentSupport::getURL($param));
    }

    public function result(Request $r)
    {
        //get the transaction made
        PaymentTransaction::whereTxnid($r->txnid)->first()->update([
            'message' => $r->message,
            'ref_no' => $r->refno,
            'status' => PaymentTransaction::STATUSES[$r->status],
        ]);

        $status = $r->status;
        $message = $r->message;
        $refno = $r->refno;
        return view('payment.result', compact('status', 'message', 'refno'));
    }
}
