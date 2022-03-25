<?php

namespace App\Models\Traits;

trait BelongsToUser
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
