<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    use HasFactory;

    protected $fillable = [
        'model_id',
        'model_type',
        'title',
        'body',
        'read_at',
        'answer',
        'type',
        'answered_at',
        'user_id', // the user who will receive the invitation.
    ];

    const TYPE_GROUP = 'Group Invitation';

    public function model()
    {
        return $this->morphTo();
    }
}
