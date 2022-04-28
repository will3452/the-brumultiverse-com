<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Preview extends Model {

    protected $fillable = [
        'mediable_id',
        'mediable_type',
        'path',
        'copyright_disclaimer',
    ];
}
