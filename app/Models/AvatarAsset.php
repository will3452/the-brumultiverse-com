<?php

namespace App\Models;

use App\Models\Traits\HasThumbnail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AvatarAsset extends Model
{
    use HasFactory,
        HasThumbnail;

    protected $with = ['thumbnail'];

    protected $fillable = [
        'type',
        'name',
        'for_premium',
        'gender',
        'college',
        'cost',
        'cost_type',
        'path',
    ];

    const TYPE_HAIR = 'Hairstyles';
    const TYPE_CLOTHES = 'Clothes';

    const THUMBNAIL_SIZE = [90, 140];
}
