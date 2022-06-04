<?php
namespace App\Models\Traits;

use App\Models\Balance;

trait BalanceTrait
{
    public function balance ()
    {
        return $this->hasOne(Balance::class, 'user_id');
    }

    public function hasBalance(): bool
    {
        return $this->balance()->exists();
    }
}
