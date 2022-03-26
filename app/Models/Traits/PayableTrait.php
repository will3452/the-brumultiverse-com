<?php

namespace App\Models\Traits;

use App\Models\PaymentTransaction;

trait PayableTrait
{
    public function transactions()
    {
        return $this->morphMany(PaymentTransaction::class, 'model');
    }

    public function wasPaid(): bool
    {
        return $this->transactions()->whereStatus(PaymentTransaction::STATUS_SUCCESS)->exists();
    }
}
