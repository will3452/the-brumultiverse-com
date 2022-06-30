<?php

namespace App\Models\Traits;

use App\Models\Comment;

trait CommentTrait
{
    public function comments ()
    {
        return $this->morphMany(Comment::class, 'model');
    }

    public function isUserAlreadyComment ($userId): bool
    {
        return $this->comments()->whereUserId($userId)->exists();
    }

    public function hasAlreadyComment ($type, $userId): bool
    {
        return Comment::whereUserId($userId)->whereModelType($type)->whereModelId($this->id)->exists();
    }

}
