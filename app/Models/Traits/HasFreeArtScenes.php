<?php

namespace App\Models\Traits;

use App\Models\FreeArtScene;

trait HasFreeArtScenes
{
    public function freeArtScenes()
    {
        return $this->morphMany(FreeArtScene::class, 'model');
    }

    public function hasArtScene(): bool
    {
        return count($this->freeArtScenes) > 0;
    }

    public function freeArtScene()
    {
        return $this->freeArtScenes()->latest()->first()->artScene;
    }
}
