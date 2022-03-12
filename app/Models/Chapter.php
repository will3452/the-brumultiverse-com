<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    use HasFactory;

    protected $fillable = [
        'model_id',
        'model_type',
        'title',
        'cost_type',
        'cost',
        'type',
        'number',
        'content', // pdf, text
    ];

    const TYPE_PREMIUM = 'Premium';
    const TYPE_REGULAR = 'Regular';

    public function model()
    {
        return $this->morphTo();
    }
}
