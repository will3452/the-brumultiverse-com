<?php

namespace App\Models;

use App\Models\Traits\PayableTrait;
use App\Models\Traits\BelongsToUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subscription extends Model
{
    use HasFactory,
        PayableTrait,
        BelongsToUser;

        protected $fillable = [
            'user_id',
        ];
}
