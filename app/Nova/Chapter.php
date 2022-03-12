<?php

namespace App\Nova;

use App\Models\Category;
use Illuminate\Support\Str;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Trix;
use App\Helpers\CrystalHelper;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\MorphTo;
use App\Models\Chapter as ModelsChapter;
use Laravel\Nova\Http\Requests\NovaRequest;

class Chapter extends Resource
{
    public static $displayInNavigation = false;
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Chapter::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'title';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'title',
    ];

    public function getViaModel()
    {
        if (is_null(request()->viaResourceId)) {
            return $this->model;
        }
        $resource = request()->viaResource;
        $resourceId = request()->viaResourceId;

        //get the actual model
        $resourceNameArray = explode('-', $resource); // just remove All '-'
        $newWords = [];

        if (count($resourceNameArray) > 1) {
            $resourceNameArray[count($resourceNameArray) - 1] = Str::singular($resourceNameArray[count($resourceNameArray) - 1]);
        } else {
            $resourceNameArray[0] = Str::singular($resourceNameArray[0]);
        }

        foreach ($resourceNameArray as $word) {
            $newWords[] = ucfirst($word); // just make all words capitalize
        }

        $modelName = implode($newWords, ''); // combine all array items

        return ("\\App\\Models\\$modelName")::find($resourceId);
    }

    public function isTextBased()
    {
        return $this->getViaModel()->category->file_type === Category::FILE_TYPE_TEXT;
    }

    public function isPdfBased()
    {
        return $this->getViaModel()->category->file_type === Category::FILE_TYPE_PDF;
    }

    public function numberHint()
    {
        if (! $this->getViaModel()->chapters()->count()) {
            return "This will be the first chapter.";
        }
        return "The latest number of chapter added to book was " . $this->getViaModel()->chapters()->latest()->first()->number . "."; // get the latest number
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            MorphTo::make('model')
                ->exceptOnForms(),
            Text::make('Title')
                ->rules(['required']),
            Number::make('Number')
                ->sortable()
                ->help($this->numberHint())->rules(['required']),
            Select::make('Type')
                ->options([
                    ModelsChapter::TYPE_REGULAR => ModelsChapter::TYPE_REGULAR,
                    ModelsChapter::TYPE_PREMIUM => ModelsChapter::TYPE_PREMIUM,
                ])
                ->rules(['required']),
            Trix::make('Content')
                ->canSee(fn () => $this->isTextBased())
                ->alwaysShow()
                ->rules(['required']),
            File::make('Content')
                ->canSee(fn () => $this->isPdfBased())
                ->rules(['required']),
            Select::make('Crystal/Ticket/Passes', 'cost_type')
                ->options([
                    'None' => 'None',
                    CrystalHelper::WHITE_CRYSTAL => CrystalHelper::WHITE_CRYSTAL,
                    CrystalHelper::PURPLE_CRYSTAL => CrystalHelper::PURPLE_CRYSTAL,
                    CrystalHelper::HALL_PASS => CrystalHelper::HALL_PASS,
                    CrystalHelper::SILVER_TICKET => CrystalHelper::SILVER_TICKET,
                ]),
            Number::make('Cost', 'cost')
                ->rules(['required', 'gt:-1'])
                ->default(fn () => 0),
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
