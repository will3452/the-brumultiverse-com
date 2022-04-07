<?php

namespace App\Models\Traits;

trait DormTrait
{
    public function getDorm()
    {
        return $this->isGenderMale() ? '/male-dorm/base.png' : '/female-dorm/base.png';
    }
}
