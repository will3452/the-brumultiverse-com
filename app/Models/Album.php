<?php

namespace App\Models;

use App\Models\Traits\BelongsToAccount;
use App\Models\Traits\HasCover;
use App\Models\Traits\HasPublishApproval;
use App\Models\Traits\HasWorks;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory,
        HasCover,
        HasPublishApproval,
        HasWorks,
        BelongsToAccount;

    protected $fillable = [
        'title',
        'type',
        'description',
        'credit', //credits
        'account_id',
        'user_id',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    const TYPE_SONG = 'Song';
    const TYPE_ART_SCENE = 'Art Scene';
}
