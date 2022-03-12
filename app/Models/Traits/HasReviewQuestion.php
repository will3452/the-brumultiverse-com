<?php

namespace App\Models\Traits;

use App\Models\ReviewQuestion;

trait HasReviewQuestion
{
    public function reviewQuestions()
    {
        return $this->morphMany(ReviewQuestion::class, 'model');
    }
}
