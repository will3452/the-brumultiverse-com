<?php

namespace App\Models;

use App\Helpers\FileHelper;
use Illuminate\Http\Request;
use App\Models\Traits\HasMedia;
use App\Models\Traits\HasPackage;
use App\Models\Traits\PayableTrait;
use App\Models\Traits\BelongsToUser;
use App\Models\Traits\MarketingTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SlidingBanner extends Model
{
    use HasFactory,
        PayableTrait,
        HasPackage,
        MarketingTrait,
        BelongsToUser,
        HasMedia;

    protected $fillable = [
        'user_id',
        'package_id',
        'scheduled_at',
        'status',
    ];

    protected $casts = [
        'scheduled_at' => 'date',
    ];

    public static function processToCreate($data, Request $request)
    {
        $data['user_id'] = auth()->id();
        $slideBanner = self::create($data);

        if ($request->has('file')) {
            $file = FileHelper::save($request->file);
            $slideBanner->media()->create([
                'path' => $file,
                'copyright_disclaimer' => true,
            ]);
        }
        return $slideBanner;
    }

}
