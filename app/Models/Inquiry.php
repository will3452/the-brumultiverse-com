<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    use HasFactory;
    protected $fillable = [
        'email',
        'message',
        'status', //solved, new,
        'solved_by_user_id',
        'solved_at',
    ];

    const STATUS_NEW = 'New';
    const STATUS_SOLVED = 'Solved';

    public function user()
    {
        return $this->belongsTo(User::class, 'solved_by_user_id');
    }
}
