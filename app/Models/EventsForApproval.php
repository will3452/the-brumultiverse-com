<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;

class EventsForApproval extends Event
{
    protected $table = 'events';

    public static function booted()
    {
        static::addGlobalScope('events-for-approval', function (Builder $q) {
            $q->whereStatus(Event::STATUS_FOR_APPROVAL);
        });
    }
}
