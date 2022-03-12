<?php
namespace App\Models\Traits;

use App\Models\Invitation;

trait HasInvitation
{
    public function invitation()
    {
        return $this->morphOne(Invitation::class, 'model');
    }
}
