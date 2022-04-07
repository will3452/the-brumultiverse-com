<?php

namespace App\Models;

use App\Models\Traits\DormTrait;
use App\Models\Traits\HasChat;
use App\Models\Traits\HasMarket;
use App\Models\Traits\HasPaymentTransactions;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Traits\ScholarTrait;
use App\Models\Traits\StudentTrait;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasMarket,
        HasPaymentTransactions,
        HasApiTokens,
        HasFactory,
        Notifiable,
        HasChat,
        ScholarTrait,
        StudentTrait,
        DormTrait,
        HasRoles;

    protected $with = [
        // 'accounts',
    ];

    protected $withCount = [
        'unreadNotifications',
    ];
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'middle_name',
        'user_name',
        'gender',
        'sex',
        'address',
        'country',
        'city',
        'picture',
        'account_type',
        'role',
        'birth_date',
        'email',
        'password',
        'last_login_at',
        'email_verified_at',
    ];

    //helper methods
    public function isAdmin()
    {
        return $this->hasRole(Role::SUPERADMIN);
    }

    public function isGenderMale(): bool
    {
        return $this->gender === self::GENDER_MALE;
    }

    const ACCOUNT_PREMIUM = 'Premium';
    const ACCOUNT_FREE = 'Free';

    const ROLE_AUTHOR = 'Author';
    const ROLE_NORMAL = 'Normal';
    const ROLE_ARTIST = 'Artist';
    const ROLE_ADMIN = 'Super Admin';

    const GENDER_MALE = 'Male';
    const GENDER_FEMALE = 'Female';
    const GENDER_LGBT = 'Non-Binary';

    public function isScholar(): bool
    {
        return $this->hasRole(self::ROLE_ARTIST) ||
            $this->hasRole(self::ROLE_AUTHOR);
    }

    public function aan()
    {
        return $this->hasOne(Aan::class);
    }

    public function interest()
    {
        return $this->hasOne(Interest::class);
    }

    public function accounts()
    {
        return $this->hasMany(Account::class);
    }

    public function hasAccountsApproved(): bool
    {
        return $this->accounts()->whereNotNull('approved_at')->exists();
    }

    public function groups() // method to fetch all group where user belongs
    {
        $accountIds = $this->accounts->pluck('id')->toArray();
        return GroupMember::whereStatus(GroupMember::STATUS_CONFIRMED)
            ->whereIn('account_member_id', $accountIds)
            ->get();
    }

    public function getNameAttribute()
    {
        return "$this->first_name $this->last_name";
    }


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];


    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'birth_date' => 'datetime',
        'last_login_at' => 'datetime',
    ];

    public function updateLastLogin()
    {
        return $this->update(['last_login_at' => now()]);
    }
}
