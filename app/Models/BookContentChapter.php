<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookContentChapter extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_id',
        'book_content_id',
        'age_restriction',
        'type',
        'start_page',
        'end_page',
        'cost',
        'cost_type',
        'authors_note',
        'description',
        'sq', // seq
    ];

    const TYPE_PREMIUM = 'Premium';
    const TYPE_REGULAR = 'Regular';
    const TYPE_SPECIAL = 'Special';
    const TYPE_PREMIUM_WITH_FREE_ART_SCENE = 'Premium w/ Free Art Scene';
    const TYPE_PLATINUM = 'Platinum'; // exclusive for platinum books
    const TYPES = [self::TYPE_REGULAR, self::TYPE_SPECIAL, self::TYPE_PREMIUM];
    public function book ()
    {
        return $this->belongsTo(Book::class, 'book_id');
    }

    public function bookContent ()
    {
        return $this->belongsTo(BookContent::class, 'book_content_id');
    }
}
