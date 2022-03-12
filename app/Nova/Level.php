<?php

namespace App\Nova;

use App\Models\Level as ModelsLevel;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Level extends Resource
{
    public static $displayInNavigation = false;
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Level::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public function title(): string
    {
        return $this->name;
    }

    public function subtitle()
    {
        return "level -" . $this->number;
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'genre_id',
        'age_restriction',
        'number',
        'type',
        'name',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            BelongsTo::make('Genre', 'genre', Genre::class)
                ->readonly(),
            Number::make('Level Number', 'number')
                ->rules(['required']),
            Text::make('Level Name', 'name')
                ->rules(['required']),
            Select::make('Type')
                ->options([
                    ModelsLevel::TYPE_HEAT => ModelsLevel::TYPE_HEAT,
                    ModelsLevel::TYPE_VIOLENCE => ModelsLevel::TYPE_VIOLENCE,
                ])->rules(['required']),
            Number::make('Age Restriction')
                ->rules(['required'])
                ->help('X and above.'),
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
