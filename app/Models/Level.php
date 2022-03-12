<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    use HasFactory;
    protected $fillable = [
        'genre_id',
        'age_restriction',
        'name',
        'number',
        'type',
    ];

    const TYPE_HEAT = 'Heat';
    const TYPE_VIOLENCE = 'Violence';

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

}
