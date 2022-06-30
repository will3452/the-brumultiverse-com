<?php

namespace App\Models;

use App\Models\Traits\BelongsToUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory, BelongsToUser;
    protected $fillable = [
        'model_id',
        'model_type',
        'text',
        'user_id',
    ];

    public function model () {
        return $this->morphTo();
    }
}
