<?php 

namespace App\Models; 

use Illuminate\Database\Eloquent\Builder;

class Scholar extends User {
    protected $table = 'users'; 

    public static function booted()
    {
        static::addGlobalScope('scholars', function (Builder $q) {
            $q->whereRole(User::ROLE_SCHOLAR); 
        });
    }
}