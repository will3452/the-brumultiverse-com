<?php

namespace App\Nova;

use App\Models\Category as ModelsCategory;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Category extends Resource
{
    public static $group = 'data';
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Category::class;

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
        'id',
        'name'
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
            Text::make('Name')
                ->rules(['required']),
            Select::make('File Type')
                ->options([
                    ModelsCategory::FILE_TYPE_TEXT => ModelsCategory::FILE_TYPE_TEXT,
                    ModelsCategory::FILE_TYPE_PDF => ModelsCategory::FILE_TYPE_PDF,
                    ModelsCategory::FILE_TYPE_AUDIO => ModelsCategory::FILE_TYPE_AUDIO,
                    ModelsCategory::FILE_TYPE_VIDEO => ModelsCategory::FILE_TYPE_VIDEO,
                ])->rules(['required']),

            Select::make('Work Type')
                ->options([
                    ModelsCategory::WORK_TYPE_ART_SCENE => ModelsCategory::WORK_TYPE_ART_SCENE,
                    ModelsCategory::WORK_TYPE_BOOK => ModelsCategory::WORK_TYPE_BOOK,
                    ModelsCategory::WORK_TYPE_AUDIO_BOOK => ModelsCategory::WORK_TYPE_AUDIO_BOOK,
                    ModelsCategory::WORK_TYPE_PODCAST => ModelsCategory::WORK_TYPE_PODCAST,
                    ModelsCategory::WORK_TYPE_FILM => ModelsCategory::WORK_TYPE_FILM,
                    ModelsCategory::WORK_TYPE_ART_SCENE => ModelsCategory::WORK_TYPE_ART_SCENE,
                ])
                ->rules(['required']),
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
