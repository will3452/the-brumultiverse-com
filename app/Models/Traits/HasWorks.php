<?php

namespace App\Models\Traits;

use App\Models\ClassWork;

trait HasWorks
{
    public function works()
    {
        return $this->morphMany(ClassWork::class, 'class');
    }
}
