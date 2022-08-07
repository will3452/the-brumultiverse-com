<?php

namespace App\Models\Traits;

use App\Models\Genre;
use App\Models\Level;
use App\Models\Category;
use App\Models\Language;

trait BookTrait
{
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

    public function language()
    {
        return $this->belongsTo(Language::class);
    }

    public function violenceLevel()
    {
        return $this->belongsTo(Level::class, 'violence_level_id');
    }

    public function heatLevel()
    {
        return $this->belongsTo(Level::class, 'heat_level_id');
    }

    public function getLastChapterIdAttribute() {
        // optional($book->bookContentChapters()->where('sq', '!=', '-9999')->where('sq', '!=', '9999')->orderBy('sq', 'DESC')->first())->sq
        if (! $this->bookContentChapters()->count()) {
            return 1;
        }
        $last = $this->bookContentChapters()->where('sq', '!=', '-9999')->where('sq', '!=', '9999')->get()->max('sq');
        if (! $last) {
            return 1;
        }
        return $last;
    }
}
