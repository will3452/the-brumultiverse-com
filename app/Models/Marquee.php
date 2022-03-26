<?php

namespace App\Models;

use App\Models\Traits\BelongsToUser;
use App\Models\Traits\HasPackage;
use App\Models\Traits\PayableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marquee extends Model
{
    use HasFactory,
        PayableTrait,
        HasPackage,
        BelongsToUser;

    protected $fillable = [
        'user_id',
        'package_id',
        'scheduled_at',
        'content',
        'status',
    ];

    protected $casts = [
        'scheduled_at' => 'date',
    ];

    public static function processToCreate($data, Request $request)
    {
        $data['user_id'] = auth()->id();
        $marquee = self::create($data);
        return $marquee;
    }
}
