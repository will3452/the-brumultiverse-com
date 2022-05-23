<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\HasOne;
use Laravel\Nova\Fields\Hidden;
use Laravel\Nova\Fields\Select;
use App\Helpers\MarketingHelper;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\MorphMany;
use App\Nova\Traits\MarketingTrait;
use Laravel\Nova\Http\Requests\NovaRequest;

class Bulletin extends Resource
{
    use MarketingTrait;

public static $group = 'Marketing';

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Bulletin::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'date',
    ];

    const PACKAGE_TYPE = \App\Models\Package::TYPE_BULLETIN;

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            Date::make('Created date', 'created_at')
                ->sortable()
                ->exceptOnForms(),
            BelongsTo::make('User', 'user', User::class)
                ->exceptOnForms(),
            Select::make('Package', 'package_id')
                ->rules(['required'])
                ->displayUsingLabels()
                ->options($this->optionPackages()),
            Date::make('Scheduled At')
                ->rules(['required', 'after:now']),
            Text::make('Headline')
                ->rules(['required']),
            Textarea::make('Content')
                ->alwaysShow()
                ->rules(['required']),
            Hidden::make('user_id')
                ->default(fn () => auth()->id()),
            Select::make('Status')
                ->options([
                    MarketingHelper::STATUS_DRAFT => MarketingHelper::STATUS_DRAFT,
                    MarketingHelper::STATUS_RESUBMIT => MarketingHelper::STATUS_RESUBMIT,
                    MarketingHelper::STATUS_SAVED => MarketingHelper::STATUS_SAVED,
                    MarketingHelper::STATUS_ENDED => MarketingHelper::STATUS_ENDED,
                    MarketingHelper::STATUS_RUNNING => MarketingHelper::STATUS_RUNNING,
                ])
                ->rules(['required']),
            MorphMany::make('Media', 'media', Media::class),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
