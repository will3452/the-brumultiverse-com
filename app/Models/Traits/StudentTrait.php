<?php

namespace App\Models\Traits;

use App\Models\Book;
use App\Models\BookContentChapter;
use App\Models\ReadingLog;
use App\Models\StudentCollection;
use App\Models\User;
use Illuminate\Support\Str;
use App\Models\Subscription;
use Exception;

trait StudentTrait
{
    public function canProceedToRead(Book $book, BookContentChapter $chapter) {
        try {
            error_log("CHAPTER TYPE >> " . $chapter->type);
            if ($chapter->isType(BookContentChapter::TYPE_REGULAR)) {
                return $this->hasEnoughBalanceOf('hall_pass');
            }

            if ($chapter->isType(BookContentChapter::TYPE_PREMIUM)) {
                return $this->hasEnoughBalanceOf('purple_crystal');
            }

            if ($chapter->isType(BookContentChapter::TYPE_SPECIAL)) {
                return $this->hasEnoughBalanceOf('hall_pass');
            }

            return false;
        } catch (Exception $err) {
            return false;
        }
    }

    //reading logs
    public function readingLogs()
    {
        return $this->hasMany(ReadingLog::class, 'user_id');
    }
    // collections
    public function studentCollections()
    {
        return $this->hasMany(StudentCollection::class);
    }

    public function isInStudentCollections($work)
    {
        return $this->studentCollections()
            ->whereModelType(get_class($work))
            ->whereModelId($work->id)
            ->exists();
    }

    public function canAddToCollection($work)
    {
        if ($this->isInStudentCollections($work)) {
            return false;
        }
        return true;
    }

    public function canPurchaseWork($work) {
        $costType = Str::studly($work->cost_type);
        $cost = $work->cost;
        return $this->balance[$costType] >= $cost;
    }


    public function getAssistant($data = null)
    {
        $assistant = [];
        $userCollege = auth()->user()->interest->college_id;

        if ($userCollege === 1) {
            $assistant = [
                'name' => 'Miel',
                'school' => 'IS',
                'image' => getAsset('avatars/miel.png'),
            ];
        }

        if ($userCollege === 2) {
            $assistant = [
                'name' => 'Masaru',
                'school' => 'Berkeley',
                'image' => getAsset('avatars/masaru.png'),
            ];
        }

        if ($userCollege === 3) {
            $assistant = [
                'name' => 'Khiara',
                'school' => 'Reagan',
                'image' => getAsset('avatars/khiara.png'),
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

    public function isPremium()
    {
        return $this->account_type === User::ACCOUNT_PREMIUM;
    }
}
