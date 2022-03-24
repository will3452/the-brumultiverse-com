<?php

namespace App\Models;

use App\Models\Traits\BelongsToAccount;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory,
        BelongsToAccount;

    protected $fillable = [
        'user_id',
        'account_id',
        'type',
        'description',
        'cost',
        'cost_type',
        'title',
        'status',
        'start_date',
        'end_date',
    ];

    const TYPE_GROUP = 'Group';
    const TYPE_SOLO = 'Solo';

    const STATUS_DRAFT = 'Draft';
    const STATUS_FOR_APPROVAL = 'For Approval';
    const STATUS_APPROVED = 'Approved';
    const STATUS_DECLINED = 'Declined';

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    //attributes

    public function getIsApprovedAttribute()
    {
        return $this->status === self::STATUS_APPROVED;
    }

    public static function processToCreate($r) // r === request
    {
        $event = self::create([
            'user_id' => auth()->id(),
            'account_id' => $r->account,
            'title' => $r->title,
            'description' => $r->description,
            'start_date' => $r->start_date,
            'end_date' => $r->end_date,
        ]);

        return $event;
    }

    public static function processToUpdate($r, $event) // r === request
    {
        $event->update([
            'user_id' => auth()->id(),
            'account_id' => $r->account,
            'title' => $r->title,
            'description' => $r->description,
            'start_date' => $r->start_date,
            'end_date' => $r->end_date,
        ]);

        return $event;
    }
}
