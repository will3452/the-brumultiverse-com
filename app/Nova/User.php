<?php

namespace App\Nova;

use App\Nova\Actions\SendEmail;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\HasOne;
use Laravel\Nova\Fields\Select;
use Elezerk\LargeFile\LargeFile;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Fields\Country;
use Laravel\Nova\Fields\Gravatar;
use Laravel\Nova\Fields\Password;
use Laravel\Nova\Fields\MorphToMany;
use Laravel\Nova\Http\Requests\NovaRequest;

class User extends Resource
{
    public static $group = 'user Management';
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\User::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public function title()
    {
        return "$this->first_name, $this->last_name";
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'first_name',
        'last_name',
        'middle_name',
        'user_name',
        'email',
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
            Badge::make('Verified Email', fn () => $this->email_verified_at !== null ? 'Verified' : 'Unverified')
                ->map([
                    'Verified' => 'success',
                    'Unverified' => 'danger',
                ]),
            Text::make('First Name')
                ->sortable()
                ->rules('required', 'max:32'),

            Text::make('Last Name')
                ->sortable()
                ->rules('required', 'max:32'),

            Text::make('Middle Name')
                ->sortable()
                ->rules('required', 'max:32'),

            Text::make('Username', 'user_name')
                ->sortable()
                ->rules('required', 'max:20'),

            Date::make('Birth Date')
                ->rules(['required']),

            Select::make('Gender')
                ->options([
                    (static::$model)::GENDER_FEMALE => (static::$model)::GENDER_FEMALE,
                    (static::$model)::GENDER_MALE => (static::$model)::GENDER_MALE,
                    (static::$model)::GENDER_LGBT => (static::$model)::GENDER_LGBT,
                ])->rules(['required']),

            Select::make('Sex')
                ->options([
                    (static::$model)::GENDER_FEMALE => (static::$model)::GENDER_FEMALE,
                    (static::$model)::GENDER_MALE => (static::$model)::GENDER_MALE,
                    (static::$model)::GENDER_LGBT => (static::$model)::GENDER_LGBT,
                ])->rules(['required']),

            Text::make('Address', 'address')
                ->sortable()
                ->rules('required', 'max:100'),

            Country::make('Country')
                ->sortable()
                ->searchable()
                ->rules('required'),

            Text::make('City')
                ->rules(['required']),

            Image::make('Picture')
                ->rules(['required']),

            Select::make('Account Type')
                ->options([
                    (static::$model)::ACCOUNT_FREE => (static::$model)::ACCOUNT_FREE,
                    (static::$model)::ACCOUNT_PREMIUM => (static::$model)::ACCOUNT_PREMIUM,
                ])->rules(['required']),

            Select::make('Role')
                ->options([
                        (static::$model)::ROLE_NORMAL => (static::$model)::ROLE_NORMAL,
                        (static::$model)::ROLE_AUTHOR => (static::$model)::ROLE_AUTHOR,
                        (static::$model)::ROLE_ARTIST => (static::$model)::ROLE_ARTIST,
                        'Other' => 'Other',
                ])->rules(['required']),

            Text::make('Email')
                ->sortable()
                ->rules('required', 'email', 'max:254')
                ->creationRules('unique:users,email')
                ->updateRules('unique:users,email,{{resourceId}}'),

            Password::make('Password')
                ->onlyOnForms()
                ->creationRules('required', 'string', 'min:8')
                ->updateRules('nullable', 'string', 'min:8'),

            HasOne::make('AAN', 'aan'),
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
        return [
            (new SendEmail)
        ];
    }
}
