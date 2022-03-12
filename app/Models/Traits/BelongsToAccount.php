<?php

namespace App\Models\Traits;

use App\Models\User;
use App\Models\Account;

trait BelongsToAccount
{

    //relation
    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
