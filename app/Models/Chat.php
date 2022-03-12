<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', // if p2p the default name of the chat will be user1id_user2id
        'uuid', // random generated id
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    protected $with = [
        'messages',
    ];

    const MAX_MEMBER = 5;// max member of the chat
    const SEPARATOR = '__BrUmUlTiVeRsE__';

    public static function createName($n1, $n2)
    {
        return $n1 . self::SEPARATOR . $n2;
    }

    public function getConversationNameAttribute()
    {
        $name = explode(self::SEPARATOR, $this->name);
        return $name[0] === auth()->user()->user_name  ? $name[1] : $name[0];
    }
}
