<?php

namespace App\Models;

use App\Models\Traits\HasInvitation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupMember extends Model
{
    use HasFactory,
        HasInvitation;

    protected $fillable = [
        'group_id',
        'account_requestor_id', // the account of the user who request or add the group member
        'account_member_id',
        'confirmed_at',
        'remarks',
        'position', // title
        'status', // pending
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
}
