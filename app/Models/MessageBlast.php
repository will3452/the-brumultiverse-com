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

class MessageBlast extends Model
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
        'content',
        'status',
    ];

    protected $casts = [
        'scheduled_at' => 'date',
    ];

    public static function processToCreate($data, Request $request)
    {
        $data['user_id'] = auth()->id();

        $messages = $request->messages;
        $subjects = $request->subjects;

        $jsonValue = [];
        foreach ($subjects as $key => $subject) {
            $jsonValue[] = [
                'subject' => $subject,
                'messages' => $messages[$key],
            ];
        }

        $jsonValue = json_encode($jsonValue);

        $mb = self::create([
            'user_id' => auth()->id(),
            'package_id' => $request->package_id,
            'scheduled_at' => $request->scheduled_at,
            'content' => $jsonValue,
        ]); // message blast

        if ($request->has('file')) {
            $file = FileHelper::save($request->file);
            $mb->media()->create([
                'path' => $file,
                'copyright_disclaimer' => true,
            ]);
        }
        return $mb;
    }


    public function getAllMessages()
    {
        return json_decode($this->content);
    }
}
