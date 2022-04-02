<?php

namespace App\Models\Traits;

use App\Models\PaymentTransaction;

trait HasPaymentTransactions
{
    public function paymentsTransactions()
    {
        return $this->morphMany(PaymentTransaction::class, 'user_id');
    }
}
