<?php

namespace App\Models\Traits;

use App\Models\Bulletin;

trait HasMarket
{
    public function bulletins()
    {
        return $this->hasMany(Bulletin::class, 'user_id');
    }
}
