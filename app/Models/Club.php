<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Club extends Model
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
}
