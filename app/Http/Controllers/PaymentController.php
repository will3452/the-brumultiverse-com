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

    public function createTransaction($type, $id, $txnid, $amount, $description, $payload= null)
    {
        ("\\App\\Models\\$type")::findOrFail($id)->transactions()->create([
            'user_id' => auth()->id(),
            'amount' => $amount,
            'txnid' => $txnid,
            'description' => $description,
            'payload' => $payload,
        ]);
    }

    public function createParam($amount, $description)
    {
        return PaymentSupport::createParameters(
            $amount,
            config('payment.ccy'),
            $description,
            config('payment.merchant_email')
        );
    }


    public function createPayment(Request $r)
    {
        $param = $this->createParam($r->amount, $r->description);

        $this->createTransaction($r->type, $r->id, $param['txnid'], $r->amount, $r->description);

        $param = PaymentSupport::getDigestString($param);

        return redirect(PaymentSupport::getURL($param));
    }

    public function result(Request $r)
    {

        $status = $r->status;
        $message = $r->message;
        $refno = $r->refno;

        if (session()->exists('redirect')) {
            $redirectUrl = session()->get('redirect');
            session()->forget('redirect');
            return redirect($redirectUrl);
        }

        return view('payment.result', compact('status', 'message', 'refno'));
    }
}
