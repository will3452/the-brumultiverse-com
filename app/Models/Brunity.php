<?php

namespace App\Models;

use App\Models\Traits\HasCover;
use App\Models\Traits\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Brunity extends Model
{
    use HasFactory,
        HasCover;

    protected $with = ['cover'];
    protected $fillable = [
        'name',
        'email',
        'title',
        'facebook_link',
        'instagram_link',
        'youtube_link',
        'about',
    ];
}
