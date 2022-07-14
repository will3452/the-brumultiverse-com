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

    public function deductBalance($type, $value): bool
    {
        if (! $this->balance->validType($type)) {
            return false;
        }
        $newBal = $this->balance[$type] - $value;
        $this->balance()->update([$type => $newBal]); // update balance
        return true;
    }

    public function hasEnoughBalanceOf($type, $minValue = 1) {
        if (! $this->hasBalance()) return false;

        return $this->balance->validType($type) &&
            $this->balance[$type] >= $minValue;
    }
}
