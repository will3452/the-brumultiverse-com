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

class Newspaper extends Model
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
        $newspaper = self::create($data);
        if ($request->has('file')) {
            $file = FileHelper::save($request->file);
            $newspaper->media()->create([
                'path' => $file,
                'copyright_disclaimer' => true,
            ]);
        }
        return $newspaper;
    }
}
