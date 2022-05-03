<?php


namespace App\Models\Traits;

use App\Models\Avatar;

trait HasAvatar
{
    public function hasAvatarSet()
    {
        return $this->avatar_updated;
    }

    public function avatar()
    {
        return $this->hasOne(Avatar::class, 'user_id');
    }
}
