<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'number_of_days',
        'cost',
    ];

    const TYPE_BULLETIN = 'Bulletin';
    const TYPE_MARQUEE = 'Marquee';
    const TYPE_SLIDING_BANNER = 'Sliding Banner';
    const TYPE_MESSAGE_BLAST = 'Message Blast';
    const TYPE_LOADING_IMAGE = 'Loading Image';
    const TYPE_NEWSPAPER = 'Newspaper';

    const TYPE_OPTIONS = [
        self::TYPE_BULLETIN => self::TYPE_BULLETIN,
        self::TYPE_MARQUEE => self::TYPE_MARQUEE,
        self::TYPE_SLIDING_BANNER => self::TYPE_SLIDING_BANNER,
        self::TYPE_MESSAGE_BLAST => self::TYPE_MESSAGE_BLAST,
        self::TYPE_LOADING_IMAGE => self::TYPE_LOADING_IMAGE,
        self::TYPE_NEWSPAPER => self::TYPE_NEWSPAPER,
    ];
}
