<?php

namespace App\Models\Traits;

use App\Models\Chat;

trait HasChat
{
    public function chats()
    {
        return $this->belongsToMany(Chat::class);
    }

    public function getLatestChatIdAttribute()
    {
        return $this->chats()->orderBy('updated_at', 'DESC')
            ->first()
            ->id;
    }

    public function getChatUrlAttribute()
    {
        if ($this->chats()->count()) {
            return "/chats/$this->latest_chat_id";
        } else {
            return "/chats/create";
        }
    }

    public function getChat($version = null)
    {
        if (is_null($version)) {
            return $this->chat_url;
        }

        if ($version == 1) {
            if ($this->chats()->count()) {
                return '/chats-1/' . $this->latest_chat_id;
            }
            return route('chat.1.create');
        }
    }
}
