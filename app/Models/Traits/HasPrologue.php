<?php

namespace App\Models\Traits;

use App\Models\Prologue;

trait HasPrologue
{
    public function prologue()
    {
        return $this->morphOne(Prologue::class, 'model');
    }
}
