<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookContent extends Model
{
    use HasFactory;
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
