<?php

namespace App\Models;

use App\Models\Traits\BelongsToAccount;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublishApproval extends Model
{
    use HasFactory,
        BelongsToAccount;

    protected $fillable = [
        'user_id',
        'account_id',
        'model_type',
        'model_id',
        'notes',
        'preferred_date',
        'status', // approved, declined, pending
        'approved_by_user_id',
        'approved_at',
    ];

    protected $casts = [
        'approved_at' => 'datetime',
        'preferred_date' => 'date',
    ];

    const STATUS_APPROVED = 'Approved';
    const STATUS_PENDING = 'Pending';
    const STATUS_DECLINED = 'Declined';

    public function model()
    {
        return $this->morphTo();
    }

    public function approvedByUser()
    {
        return $this->belongsTo(User::class, 'approved_by_user_id');
    }
}
