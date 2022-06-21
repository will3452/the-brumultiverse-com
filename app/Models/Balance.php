<?php

namespace App\Models;

use App\Models\Traits\PayableTrait;
use App\Models\Traits\BelongsToUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Balance extends Model
{
    use HasFactory, BelongsToUser, PayableTrait;

    protected $fillable = [
        'user_id',
        'white_crystal',
        'purple_crystal',
        'hall_pass',
        'silver_ticket',
    ];

    // const WHITE_CRYSTAL = 'White Crystal';
    // const PURPLE_CRYSTAL = 'Purple Crystal';
    // const HALL_PASS = 'Hall Pass';
    // const SILVER_TICKET = 'Silver Ticket';
}
