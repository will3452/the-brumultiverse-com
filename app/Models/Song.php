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

class Song extends Model implements TaggableInterface
{
    use HasFactory,
        TaggableTrait,
        BelongsToAccount,
        HasLargeFile,
        BelongsToClass,
        HasPublishApproval,
        HasPublishApproval,
        HasCover;

    protected $with = [
            'cover',
        ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    protected $fillable = [
        'title',
        'user_id',
        'account_id',
        'genre_id',
        'description',
        'credit',
        'cost_type',
        'cost',
        'lyrics',
        'copyright',
        'not_yet_copyrighted',
        'published_at',
    ];

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }
}
