<?php

namespace App\Models;

use App\Models\Traits\HasInvitation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupMember extends Model
{
    use HasFactory,
        HasInvitation;

    protected $with = [
        // 'group',
    ];

    protected $fillable = [
        'group_id',
        'account_requestor_id', // the account of the user who request or add the group member
        'account_member_id',
        'confirmed_at',
        'remarks',
        'position', // title
        'status', // pending
        'commission_rate',
    ];

    const STATUS_PENDING = 'Waiting For Confirmation';
    const STATUS_CONFIRMED = 'Confirmed';
    const STATUS_DECLINED = 'Declined';

    protected $casts = [
        'confirmed_at' => 'datetime',
    ];

    public function member()
    {
        return $this->belongsTo(Account::class, 'account_member_id');
    }

    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id');
    }

    //scopes and helpers

    public function scopeConfirmed($q)
    {
        return $q->whereStatus(self::STATUS_CONFIRMED);
    }

    public function scopePending($q)
    {
        return $q->whereStatus(self::STATUS_PENDING);
    }
}
