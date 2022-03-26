<?php

namespace App\Models;

use App\Helpers\FileHelper;
use Illuminate\Http\Request;
use App\Models\Traits\HasMedia;
use App\Models\Traits\HasPackage;
use App\Models\Traits\BelongsToUser;
use App\Models\Traits\MarketingTrait;
use App\Models\Traits\PayableTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bulletin extends Model
{
    use HasFactory,
        MarketingTrait,
        PayableTrait,
        BelongsToUser,
        HasPackage,
        HasMedia;

    protected $fillable = [
        'user_id',
        'package_id',
        'scheduled_at',
        'headline',
        'content',
        'status',
    ];

    protected $casts = [
        'scheduled_at' => 'date',
    ];


    public static function processToCreate($data, Request $request)
    {
        $data['user_id'] = auth()->id();
        $bulletin = self::create($data);
        if ($request->has('file')) {
            $file = FileHelper::save($request->file);
            $bulletin->media()->create([
                'path' => $file,
                'copyright_disclaimer' => true,
            ]);
        }
        return $bulletin;
    }
}
