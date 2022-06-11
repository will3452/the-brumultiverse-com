<?php

namespace App\Models;

use App\Models\Traits\HasBookContentChapter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookContent extends Model
{
    use HasFactory, HasBookContentChapter;
    protected $fillable = [
        'book_id',
        'pdf',
        'number_of_pages',
    ];

    public function book ()
    {
        return $this->belongsTo(Book::class, 'book_id');
    }
}
