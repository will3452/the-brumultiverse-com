<?php

namespace App\Http\Controllers\Traits;

trait StudentCollection
{
    public function getWorks()
    {
        return ($this->getModel())::whereIn('id', $this->myWorkCollection())->get()->groupBy(fn ($e) =>  $e->genre->name);
    }

    public function myWorkCollection(): array
    {
        return auth()->user()->studentCollections()->whereModelType($this->getModel())->pluck('model_id')->toArray();
    }
}
