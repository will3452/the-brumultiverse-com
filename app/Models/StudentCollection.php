<?php

namespace App\Models;

use App\Models\Traits\BelongsToUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentCollection extends Model
{
    use HasFactory, BelongsToUser;
    protected $fillable = [
        'user_id',
        'model_type',
        'model_id',
    ];

    public function model()
    {
        return $this->morphTo('model');
    }

}
