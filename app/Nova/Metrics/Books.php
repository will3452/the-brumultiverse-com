<?php

namespace App\Nova\Metrics;

use App\Models\Book;
use App\Models\Role;
use App\Nova\Metrics\Traits\PublishedCount;
use Laravel\Nova\Metrics\Partition;
use Laravel\Nova\Http\Requests\NovaRequest;

class Books extends Partition
{
    use PublishedCount;
    public static $model = Book::class;


    /**
     * Determine for how many minutes the metric should be cached.
     *
     * @return  \DateTimeInterface|\DateInterval|float|int
     */
    public function cacheFor()
    {
        // return now()->addMinutes(5);
    }

    /**
     * Get the URI key for the metric.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'books';
    }
}
