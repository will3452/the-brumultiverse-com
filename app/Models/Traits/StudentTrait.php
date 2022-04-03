<?php

namespace App\Models\Traits;

use App\Models\Subscription;

trait StudentTrait
{
    public function getAssistant($data = null)
    {
        $assistant = [];
        $userCollege = auth()->user()->interest->college_id;

        if ($userCollege === 1) {
            $assistant = [
                'name' => 'Miel',
                'school' => 'IS',
                'image' => '/students/character/miel.png',
            ];
        }

        if ($userCollege === 2) {
            $assistant = [
                'name' => 'Masaru',
                'school' => 'Berkeley',
                'image' => '/students/character/masaru.png',
            ];
        }

        if ($userCollege === 3) {
            $assistant = [
                'name' => 'Khiara',
                'school' => 'Reagan',
                'image' => '/students/character/khiara.png',
            ];
        }

        return is_null($data) ? $assistant : $assistant[$data];
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class, 'user_id');
    }

    public function hasSubscription()
    {
        return $this->subscriptions()->exists();
    }

    public function changeSubscription($newSubscription)
    {
        $this->update(['account_type' => $newSubscription]);
    }
}
