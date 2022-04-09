<?php

namespace App\Models\Traits;

use App\Models\College;

trait BelongsToCollege
{
    public function college()
    {
        return $this->belongsTo(College::class);
    }
}
