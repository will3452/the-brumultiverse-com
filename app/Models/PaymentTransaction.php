<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentTransaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'model_id',
        'model_type',
        'txnid', // transaction id
        'description',
        'amount',
        'ref_no',
        'message',
        'status',
        'payload',
    ];
    const STATUS_SUCCESS = 'Success';
    const STATUS_PENDING = 'Pending';
    const STATUS_FAILURE = 'Failure';

    const STATUSES = [
        'S' => self::STATUS_SUCCESS,
        'P' => self::STATUS_PENDING,
        'F' => self::STATUS_FAILURE,
    ];

    public function model()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
