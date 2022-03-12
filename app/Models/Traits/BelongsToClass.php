<?php

namespace App\Models\Traits;

use App\Models\ClassWork;

trait BelongsToClass
{
    public function modelClass()
    {
        return $this->morphMany(ClassWork::class, 'work');
    }
}
