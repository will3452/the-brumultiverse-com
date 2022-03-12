<?php

namespace App\Models\Traits;

use App\Models\FreeArtScene;

trait HasFreeArtScenes
{
    public function freeArtScenes()
    {
        return $this->morphMany(FreeArtScene::class, 'model');
    }
}
