<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;
    protected $fillable = [
        'model_id',
        'model_type',
        'path',
        'type', // extensions. mp3, .jpg, .3pg, .mp4 .., etc,
        'copyright_disclaimer',
    ];
}
