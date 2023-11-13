<?php

namespace App\Models\Traits;

use App\Models\PublishApproval;

trait HasPublishApproval
{
    public function publishApprovals()
    {
        return $this->morphMany(PublishApproval::class, 'model');
    }

    public function wasPublishedApproved(): bool
    {
        return $this->publishApprovals()->whereStatus(PublishApproval::STATUS_APPROVED)->exists();
    }

    public function hasPendingPublishApproval(): bool
    {
        return $this->publishApprovals()->whereStatus(PublishApproval::STATUS_PENDING)->exists();
    }

    public function scopePublished($q)
    {
        return $q->whereNotNull('published_at')->whereDate('published_at', '>=', now());
    }

    public function scopeNotPublished($q)
    {
        return $q->whereNull('published_at');
    }

    public function modelType($absolute = false)
    {
        if ($absolute) {
            $arr = explode("\\", self::class);
            return end($arr);
        }
        return self::class;
    }

    public function hasPublishedDate(): bool
    {
        return ! is_null($this->published_at);
    }
}
