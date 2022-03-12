<?php
namespace App\Models\Traits;

use App\Models\Invitation;

trait HasInvitations
{
    public function invitations()
    {
        return $this->morphMany(Invitation::class, 'model');
    }
}
