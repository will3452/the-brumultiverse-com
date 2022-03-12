<?php

namespace App\Models;

use App\Models\Traits\HasCover;
use Cartalyst\Tags\TaggableTrait;
use App\Models\Traits\HasLargeFile;
use Cartalyst\Tags\TaggableInterface;
use App\Models\Traits\BelongsToAccount;
use App\Models\Traits\BelongsToClass;
use App\Models\Traits\HasPublishApproval;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Podcast extends Model implements TaggableInterface
{
    use HasFactory,
        BelongsToAccount,
        BelongsToClass,
        HasCover,
        HasLargeFile,
        HasPublishApproval,
        TaggableTrait;

    protected $with = [
        'cover',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'launch_at' => 'date',
    ];

    protected $fillable = [
        'title',
        'account_id',
        'user_id',
        'description',
        'credit',
        'type', // regular | premium
        'cost_type',
        'cost',
        'launch_at',
        'published_at',
    ];

    const TYPE_REGULAR = 'Regular';
    const TYPE_PREMIUM = 'Premium';
}
