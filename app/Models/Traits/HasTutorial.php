<?php

namespace App\Models\Traits;

trait HasTutorial
{
    public function isFinishedTutorial()
    {
        return $this->tutorial_finished;
    }

    public function finishTutorial()
    {
        $this->update(['tutorial_finished' => true]);
    }
}
