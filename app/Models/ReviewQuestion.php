<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewQuestion extends Model
{
    use HasFactory;
    protected $fillable = [
        'model_id',
        'model_type',
        'review_question',
    ];

    public function model()
    {
        return $this->morphTo();
    }
}
