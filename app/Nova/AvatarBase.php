<?php

namespace App\Nova;

use App\Models\AvatarBase as ModelsAvatarBase;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class AvatarBase extends Resource
{
    public static $group = 'Avatar';
    public static function label()
    {
        return 'Avatar';
    }
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\AvatarBase::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'group',
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
            Select::make('Group')
                ->options(function () {
                    $arr = [];
                    $groups = ModelsAvatarBase::GROUP;
                    foreach ($groups as $value) {
                        $arr[$value] = $value;
                    }
                    return $arr;
                }),
            Text::make('Name')
                ->rules(['required']),
            Select::make('Gender')
                ->options([
                    ModelsAvatarBase::GENDER[0] => ModelsAvatarBase::GENDER[0],
                    ModelsAvatarBase::GENDER[1] => ModelsAvatarBase::GENDER[1],
                ]),
            Image::make('Path')
                ->rules(['required'])
                ->help('dim: 420x594 px'),
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
