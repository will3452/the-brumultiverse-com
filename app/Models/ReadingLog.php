<?php

namespace App\Models;

use App\Models\Traits\BelongsToUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReadingLog extends Model
{
    use HasFactory, BelongsToUser;
    protected $fillable = [
        'user_id',
        'book_id',
        'chapter_id',
        'page_number',
    ];
}
