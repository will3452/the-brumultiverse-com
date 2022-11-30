<?php

namespace App\Models;

use App\Helpers\CountryHelper;
use App\Models\Traits\ScholarTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory,
        ScholarTrait;

    protected $fillable = [
        'user_id',
        'gender',
        'country',
        'penname',
        'picture',
        'copyright_disclaimer',
        'approved_at',
        'type',
    ];

    // protected $with = [
    //     'books',
    //     'artScenes',
    //     'audioBooks',
    //     'podcasts',
    //     'songs',
    //     'films',
    // ];

    protected $casts = [
        'approved_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function markAsApproved()
    {
        $this->approved_at = now();
        return $this->save();
    }

    public static function getApprovedAccountsFor($id)
    {
        return self::whereUserId($id)->whereNotNull('approved_at')->get()->pluck('penname', 'id');
    }

    public function getCountryFullAttribute()
    {
        return CountryHelper::getAllCountries()[$this->country] . " - " . $this->country;
    }


    public function groups () {
        $groups = $this->groupMembers()->get()->pluck('group_id')->all();
        return Group::whereIn('id', $groups);
    }

    public function groupMembers () {
        return GroupMember::whereAccountMemberId($this->id);
    }
}
