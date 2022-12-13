<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Royalty extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_id',
        'account_member_id',
        'rate',
        'group_id',
    ];

    public function account()
    {
        return $this->belongsTo(Account::class, 'account_member_id');
    }

    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id');
    }

    public function book () {
        return $this->belongsTo(Book::class);
    }
}
