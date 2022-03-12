<?php

namespace App\Models;

use App\Models\Traits\BelongsToAccount;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Group extends Model
{
    use HasFactory,
        BelongsToAccount;

    protected $fillable = [
        'name',
        'user_id',
        'account_id', // group creator
        'type',
        'description', //short, about
        'status', //pending, banned, active, in-active, declined
        'approved_at', // date
        'approved_by_user_id',
    ];

    const STATUS_PENDING = 'For Approval';
    const STATUS_BANNED = 'Banned';
    const STATUS_ACTIVE = 'Active';
    const STATUS_INACTIVE = 'In-Active';
    const STATUS_DECLINED = 'Declined';

    protected $casts = [
        'approved_at' => 'datetime',
    ];

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by_user_id');
    }

    public function members()
    {
        return $this->hasMany(GroupMember::class, 'group_id');
    }

    //helper
    public function isGroupCreator(User $user): bool
    {
        $creator = $this->account_id;
        $accountIds = $user->accounts()->pluck('id')->toArray();
        return in_array($creator, $accountIds);
    }
}
