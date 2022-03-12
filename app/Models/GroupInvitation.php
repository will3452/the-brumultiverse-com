<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;


class GroupInvitation extends Invitation
{
    protected $table = 'invitations';

    public static function booted()
    {
        static::addGlobalScope('group-invitations', function (Builder $q) {
            $q->whereType(Invitation::TYPE_GROUP);
        });
    }
}
