<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;

class PendingAccount extends Account
{
    protected $table = 'accounts';

    public static function booted()
    {
        static::addGlobalScope('pending-account', function (Builder $q) {
            $q->whereNull('approved_at');
        });
    }
}
