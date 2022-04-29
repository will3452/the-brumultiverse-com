<?php

namespace App\Models;

use App\Models\Traits\BelongsToUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Avatar extends Model
{
    use HasFactory,
        BelongsToUser;

    protected $fillable = [
        'user_id',
        'base',
        'hair',
        'dress',
    ];
}
