<?php

namespace App\Models;

use Illuminate\Http\Request;
use App\Models\Traits\HasPackage;
use App\Models\Traits\PayableTrait;
use App\Models\Traits\BelongsToUser;
use App\Models\Traits\MarketingTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Marquee extends Model
{
    use HasFactory,
        PayableTrait,
        HasPackage,
        MarketingTrait,
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
