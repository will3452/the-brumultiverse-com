<?php

namespace App\Models;

use App\Models\Traits\ScholarTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory,
        ScholarTrait;

    protected $fillable = [
        'user_id',
        'gender',
        'country',
        'penname',
        'picture',
        'copyright_disclaimer',
    ];

    protected $with = [
        'books',
        'artScenes',
        'audioBooks',
        'podcasts',
        'songs',
        'films',
    ];

    protected $casts = [
        'approved_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function markAsApproved()
    {
        $this->approved_at = now();
        return $this->save();
    }
}
