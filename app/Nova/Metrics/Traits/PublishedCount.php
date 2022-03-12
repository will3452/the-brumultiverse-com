<?php

namespace App\Nova\Metrics\Traits;

use App\Models\Role;
use Laravel\Nova\Http\Requests\NovaRequest;

trait PublishedCount
{
    /**
     * Calculate the value of the metric.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return mixed
     */
    public function calculate(NovaRequest $request)
    {
        $published = 0;
        $notPublished = 0;

        if (auth()->user()->hasRole(Role::SUPERADMIN)) {
            $published = (self::$model)::published()->count();
            $notPublished = (self::$model)::notPublished()->count();
        } else {
            $accountId = auth()->user()->accounts()->pluck('id')->toArray();
            $published = (self::$model)::published()->whereIn('account_id', $accountId)->count();
            $notPublished = (self::$model)::notPublished()->whereIn('account_id', $accountId)->count();
        }

        return $this->result([
            'Published' => $published,
            'Not Published' => $notPublished,
        ])->colors([
            'Published' => '#330747',
            'Not Published' => '#777',
        ]);
    }
}
