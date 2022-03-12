<?php

namespace App\Nova;

use App\Models\User;
use Pdmfc\NovaCards\Info;
use Laravel\Nova\Fields\ID;
use App\Rules\ShouldChecked;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Hidden;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Country;
use Laravel\Nova\Fields\BelongsTo;
use App\Nova\Actions\ApproveAccount;
use App\Nova\Traits\ForUserIndividualOnly;

class Account extends Resource
{
    use ForUserIndividualOnly;
    public static $group = 'user Management';
    public static function authorizedToCreate(Request $request)
    {
        return auth()->user()->accounts()->count() < nova_get_setting('max_account');
    }
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Account::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'penname';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'penname',
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
            Hidden::make('user_id')
                ->default(fn () => auth()->id()),

            Date::make('Registered At', 'created_at')
                ->exceptOnForms()
                ->sortable(),

            BelongsTo::make('User', 'user', \App\Nova\User::class)
                ->exceptOnForms(),

            Badge::make('Approval', fn () => is_null($this->approved_at) ? 'pending':'approved')
                ->map([
                    'approved' => 'success',
                    'pending' => 'info',
                ]),

            Text::make('PenName', 'penname')
                ->hideWhenUpdating(fn () => $this->approved_at !== null)
                ->rules(['required', 'unique:accounts,penname,{{resourceId}}']),

            Country::make('Country')
                ->rules(['required']),

            Select::make('Gender')
                ->options([
                        User::GENDER_FEMALE => User::GENDER_FEMALE,
                        User::GENDER_MALE => User::GENDER_MALE,
                        User::GENDER_LGBT => User::GENDER_LGBT,
                    ])->rules(['required']),

            Image::make('Picture')
                ->help('maximum of 5mb only')
                ->rules(['required', 'max:5000', 'image']),
            Boolean::make('Copyright Disclaimer')
                ->help(nova_get_setting('copyright_disclaimer'))
                ->rules(['required', (new ShouldChecked)]),
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
        return [
            (new Info())
                ->info('you can only create '. nova_get_setting('max_account') .' accounts.'),
        ];
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
        return [
            (new ApproveAccount())
                ->canSee(fn () => auth()->user()->hasRole(\App\Models\Role::SUPERADMIN)),
        ];
    }
}
