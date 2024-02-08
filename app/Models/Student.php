<?php 

namespace App\Models; 

use Illuminate\Database\Eloquent\Builder;

class Student extends User {
    protected $table = 'users'; 

    public static function booted()
    {
        static::addGlobalScope('students', function (Builder $q) {
            $q->whereRole(User::ROLE_NORMAL); 
        });
    }
}