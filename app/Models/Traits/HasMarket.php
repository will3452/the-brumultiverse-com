<?php

namespace App\Models\Traits;

use App\Models\Bulletin;
use App\Models\Marquee;
use App\Models\SlidingBanner;

trait HasMarket
{
    public function bulletins()
    {
        return $this->hasMany(Bulletin::class, 'user_id');
    }

    public function marquees()
    {
        return $this->hasMany(Marquee::class, 'user_id');
    }

    public function slidingBanners()
    {
        return $this->hasMany(SlidingBanner::class, 'user_id');
    }
}
