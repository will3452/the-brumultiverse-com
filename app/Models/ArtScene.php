<?php

namespace App\Models;

use App\Models\Traits\HasArtFile;
use Cartalyst\Tags\TaggableTrait;
use App\Models\Traits\BelongsToClass;
use Cartalyst\Tags\TaggableInterface;
use App\Models\Traits\BelongsToAccount;
use App\Models\Traits\HasPublishApproval;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ArtScene extends Model implements TaggableInterface
{
    use HasFactory,
        BelongsToClass,
        BelongsToAccount,
        HasArtFile,
        HasPublishApproval,
        TaggableTrait;

    protected $with = [
        'artFile',
    ];

    protected $fillable = [
        'title',
        'description',
        'account_id',
        'user_id',
        'lead_college',
        'credits',
        'cost',
        'cost_type',
        'genre_id',
        'age_restriction',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }
}
