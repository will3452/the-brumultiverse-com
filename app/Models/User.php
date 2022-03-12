<?php

namespace App\Models;

use App\Models\Traits\HasChat;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens,
        HasFactory,
        Notifiable,
        HasChat,
        HasRoles;
    protected $with = [
        'accounts',
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
    ];

    //helper methods
    public function isAdmin()
    {
        return $this->hasRole(Role::SUPERADMIN);
    }

    const ACCOUNT_PREMIUM = 'Premium';
    const ACCOUNT_FREE = 'Free';

    const ROLE_AUTHOR = 'Author';
    const ROLE_NORMAL = 'Normal';
    const ROLE_ARTIST = 'Artist';
    const ROLE_ADMIN = 'Super Admin';

    const GENDER_MALE = 'Male';
    const GENDER_FEMALE = 'Female';
    const GENDER_LGBT = 'LGBT';

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

    public function groups() // method to fetch all group where user belongs
    {
        $accountIds = $this->accounts->pluck('id')->toArray();
        return GroupMember::whereStatus(GroupMember::STATUS_CONFIRMED)
            ->whereIn('account_member_id', $accountIds)
            ->get();
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

    // //auto encrypt the password
    // public function setPasswordAttribute($value)
    // {
    //     $this->attributes['password'] = bcrypt($value);
    // }

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'birth_date' => 'datetime',
    ];
}
