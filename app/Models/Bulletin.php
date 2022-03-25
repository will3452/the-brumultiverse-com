<?php

namespace App\Models;

use App\Models\Traits\HasMedia;
use App\Models\Traits\HasPackage;
use App\Models\Traits\BelongsToUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bulletin extends Model
{
    use HasFactory,
        BelongsToUser,
        HasPackage,
        HasMedia;

    protected $fillable = [
        'user_id',
        'package_id',
        'scheduled_at',
        'headline',
        'content',
        'status',
    ];

    protected $casts = [
        'scheduled_at' => 'date',
    ];
}
