<?php

namespace App\Nova\Metrics;

use App\Models\ArtScene;
use App\Nova\Metrics\Traits\PublishedCount;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Partition;

class ArtScenes extends Partition
{
    use PublishedCount;

    public static $model = ArtScene::class;

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
        return 'art-scenes';
    }
}
