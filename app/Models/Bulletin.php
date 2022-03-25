<?php

namespace App\Models;

use App\Helpers\FileHelper;
use App\Helpers\MarketingHelper;
use Illuminate\Http\Request;
use App\Models\Traits\HasMedia;
use App\Models\Traits\HasPackage;
use App\Models\Traits\BelongsToUser;
use App\Models\Traits\IsPayable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bulletin extends Model
{
    use HasFactory,
        IsPayable,
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

    //all marking must have these

    public function saveNow()
    {
        return $this->update(['status' => MarketingHelper::STATUS_SAVED]);
    }

    public function type()
    {
        return 'Bulletin';
    }

    public function notSaved()
    {
        return $this->status !== MarketingHelper::STATUS_SAVED;
    }

    public function ref()
    {
        return $this->created_at->format('mdy') . "-" . \Str::padLeft($this->package_id, 4, 0) . "-" . $this->id;
    }
}
