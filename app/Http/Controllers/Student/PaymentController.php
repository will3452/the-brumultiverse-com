<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Supports\PaymentSupport;
use App\Http\Controllers\PaymentController as BasePaymentController;

class PaymentController extends BasePaymentController
{
    public function createSubscription()
    {
        return auth()->user()->subscriptions()->create();
    }

    public function payTuition(Request $request)
    {
        $tuitionFee = 149;
        $description = "Premium Subscription";

        $param = $this->createParam($tuitionFee, $description);

        $subscription = $this->createSubscription();


        //will create transaction base on the subscription
        $this->createTransaction('Subscription', $subscription->id, $param['txnid'], $tuitionFee, $description);


        $param = PaymentSupport::getDigestString($param);

        session(['redirect' => route('student.after.register') . '?step=10']);

        return redirect(PaymentSupport::getURL($param));
    }
}
