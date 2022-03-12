<?php

namespace App\Models;

use Spatie\Permission\Models\Role as ModelsRole;

class Role extends ModelsRole
{
    const SUPERADMIN = 'Super Admin';

    const SYSTEM_ROLES = [
        User::ROLE_ARTIST,
        User::ROLE_AUTHOR,
        User::ROLE_NORMAL,
    ];
    protected $guarded = [];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['prepared_permissions'];

    /**
     * @return mixed
     */
    public function getPreparedPermissionsAttribute()
    {
        return $this->permissions->pluck('name')->toArray();
    }


    public static function loadRole($role)
    {
        //check if the role is existing
        if (self::whereName($role)->exists()) {
            return $role;
        }

        //create role instead
        return self::create(['name' => $role]);
    }
}
