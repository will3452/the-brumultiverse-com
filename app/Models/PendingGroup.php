<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PendingGroup extends Group
{
    protected $table = 'groups';

    public static function booted()
    {
        static::addGlobalScope('pending-group', function (Builder $q) {
            $q->whereStatus(Group::STATUS_PENDING);
        });
    }
}
