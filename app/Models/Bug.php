<?php

namespace App\Models;

use App\Models\Traits\HasMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bug extends Model
{
    use HasFactory,
        HasMedia;

    protected $fillable = [
        'uri',
        'problem',
        'replacement',
        'status'
    ];

    const STATUS_FIXED = 'Fixed';
    const STATUS_PENDING = 'Pending';
}
