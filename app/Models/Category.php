<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'file_type', // upload works
        'work_type',
        'name',
    ];

    const FILE_TYPE_TEXT = 'Text';
    const FILE_TYPE_PDF = 'Pdf';
    const FILE_TYPE_AUDIO = 'Audio';
    const FILE_TYPE_VIDEO = 'Video';

    const WORK_TYPE_BOOK = 'Book';
    const WORK_TYPE_AUDIO_BOOK = 'Audio Book';
    const WORK_TYPE_PODCAST = 'Podcast';
    const WORK_TYPE_FILM = 'Film';
    const WORK_TYPE_ART_SCENE = 'Art Scene';

    const FILE_TYPES = ['Pdf', 'Text', ''];
}
