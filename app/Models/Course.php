<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'college_id',
        'name',
    ];

    public function college()
    {
        return $this->belongsTo(College::class);
    }

    public function clubs()
    {
        return $this->hasMany(Club::class);
    }
}
