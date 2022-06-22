<?php

namespace App\Models;

use App\Models\Traits\BelongsToUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentPackage extends Model
{
    use HasFactory, BelongsToUser;
    protected $fillable = [
        'type', // CRYSTAL, DRESS,
        'name',
        'cost',
        'picture',
        'content',
        'user_id',
    ];

    const DEFAULT_TYPE = 'Crystal';
}
