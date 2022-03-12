<?php

namespace App\Models\Traits;

use App\Models\PublishApproval;

trait HasPublishApproval
{
    public function publishApprovals()
    {
        return $this->morphMany(PublishApproval::class, 'model');
    }

    public function scopePublished($q)
    {
        return $q->whereNotNull('published_at');
    }

    public function scopeNotPublished($q)
    {
        return $q->whereNull('published_at');
    }
}
