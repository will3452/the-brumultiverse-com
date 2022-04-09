<?php

namespace App\Models;

use App\Models\Traits\HasThumbnail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AvatarBase extends Model
{
    use HasFactory, HasThumbnail;

    protected $fillable = [
        'group',
        'name',
        'gender',
        'path',
    ];


    const GROUP = [
        'African American',
        'Latin',
        'Asian',
        'African',
    ];

    const GENDER = [
        'Male',
        'Female',
    ];

    const THUMBNAIL_SIZE = [90, 140];
}
