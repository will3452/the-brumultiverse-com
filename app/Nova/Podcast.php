<?php

namespace App\Nova;

use App\Models\Role;
use App\Models\Account;
use Eminiarts\Tabs\Tab;
use Eminiarts\Tabs\Tabs;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Text;
use App\Helpers\CrystalHelper;
use App\Nova\Actions\SendEmail;
use Laravel\Nova\Fields\Hidden;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use App\Nova\Actions\PublishWork;
use Laravel\Nova\Fields\MorphOne;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\BelongsTo;
use App\Nova\Actions\RequestToPublish;
use App\Models\Podcast as ModelsPodcast;
use App\Nova\Traits\ForUserIndividualOnly;
use Laravel\Nova\Http\Requests\NovaRequest;

class Podcast extends Resource
{
    use ForUserIndividualOnly;
    public static $group = "Works";
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Podcast::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'title';

    public function subtitle()
    {
        return 'Podcast';
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'title',
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
            Tabs::make('Podcast', [
                Tab::make('Details', [
                    BelongsTo::make('Account', 'account', \App\Nova\Account::class)
                            ->hideWhenCreating()
                            ->hideWhenUpdating(),
                    Select::make('Account', 'account_id')
                        ->onlyOnForms()
                        ->options(
                            Account::whereUserId(auth()->id())
                                ->whereNotNull('approved_at')
                                ->get()
                                ->pluck('penname', 'id')
                        )->rules(['required']),
                    Hidden::make('user_id')
                        ->default(fn () => auth()->id()),
                    Text::make('Episode Title', 'title')
                        ->rules(['required']),
                    Textarea::make('Description')
                        ->alwaysShow()
                        ->rules(['required']),
                    Textarea::make('Credits', 'credit')
                        ->alwaysShow(),
                    Select::make('Episode Type', 'type')
                        ->options([
                            ModelsPodcast::TYPE_REGULAR => ModelsPodcast::TYPE_REGULAR,
                            ModelsPodcast::TYPE_PREMIUM => ModelsPodcast::TYPE_PREMIUM,
                        ])->rules(['required']),
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
                    Date::make('Launch Date', 'launch_at')
                        ->rules(['required']),
                ]),
                MorphOne::make('Cover', 'cover', Cover::class),
                MorphOne::make('Upload Podcast', 'largeFile', LargeMedia::class),
            ])->withToolbar(),
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
                ->canSee(fn () => auth()->user()->hasRole(Role::SUPERADMIN)),

            (new RequestToPublish),

            (new PublishWork)
                ->canSee(fn () => auth()->user()->hasRole(Role::SUPERADMIN)),
        ];
    }
}
