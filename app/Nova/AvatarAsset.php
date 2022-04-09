<?php

namespace App\Nova;

use App\Models\College;
use App\Models\AvatarBase;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use App\Helpers\CrystalHelper;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Http\Requests\NovaRequest;
use App\Models\AvatarAsset as ModelsAvatarAsset;
use App\Models\Image;
use Laravel\Nova\Fields\Image as FieldsImage;

class AvatarAsset extends Resource
{
    public static $group = 'Avatar';
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\AvatarAsset::class;

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
            Select::make('Type')
                ->options([
                    ModelsAvatarAsset::TYPE_CLOTHES => ModelsAvatarAsset::TYPE_CLOTHES,
                    ModelsAvatarAsset::TYPE_HAIR => ModelsAvatarAsset::TYPE_HAIR,
                ]),
            Text::make('Name')
                ->rules(['required']),
            Boolean::make('For Premium'),
            Select::make('Gender')
                ->options([
                    AvatarBase::GENDER[0] => AvatarBase::GENDER[0],
                    AvatarBase::GENDER[1] => AvatarBase::GENDER[1],
                ])->rules(['required']),
            Select::make('College')
                ->options(array_merge(['All' => 'All'], College::get()->pluck('name', 'name')->toArray())),
            Select::make('Crystal/Ticket/Passes', 'cost_type')
                ->options([
                    'None' => 'None',
                    CrystalHelper::WHITE_CRYSTAL => CrystalHelper::WHITE_CRYSTAL,
                    CrystalHelper::PURPLE_CRYSTAL => CrystalHelper::PURPLE_CRYSTAL,
                    CrystalHelper::HALL_PASS => CrystalHelper::HALL_PASS,
                    CrystalHelper::SILVER_TICKET => CrystalHelper::SILVER_TICKET,
                ]),
            Number::make('Cost', 'cost')
                ->rules(['gt:-1'])
                ->default(fn () => 0),
            FieldsImage::make('Image Path', 'path')->rules(['required'])
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
