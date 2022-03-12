<?php

namespace App\Models\Traits;

use App\Models\Epilogue;

trait HasEpilogue
{
    public function epilogue()
    {
        return $this->morphOne(Epilogue::class, 'model');
    }
}
