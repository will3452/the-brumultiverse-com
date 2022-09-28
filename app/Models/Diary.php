<?php

namespace App\Models;

use App\Models\Traits\BelongsToUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diary extends Model
{
    use HasFactory, BelongsToUser;
    protected $fillable = [
        'user_id',
        'title',
        'content',
        'type',
    ];

    const TYPE_IMAGE = 'Image';
    const TYPE_TEXT = 'Text';

}
