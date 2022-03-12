<?php

namespace App\Nova;

use App\Models\Role;
use App\Models\Genre;
use App\Models\Account;
use Eminiarts\Tabs\Tab;
use Eminiarts\Tabs\Tabs;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Trix;
use App\Helpers\CrystalHelper;
use App\Nova\Actions\SendEmail;
use Laravel\Nova\Fields\Hidden;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Boolean;
use App\Nova\Actions\PublishWork;
use Laravel\Nova\Fields\MorphOne;
use Laravel\Nova\Fields\Textarea;
use PalauaAndSons\TagsField\Tags;
use Laravel\Nova\Fields\BelongsTo;
use App\Nova\Actions\RequestToPublish;
use App\Nova\Traits\ForUserIndividualOnly;
use Laravel\Nova\Http\Requests\NovaRequest;

class Song extends Resource
{
    use ForUserIndividualOnly;
    public static $group = "Works";
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Song::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'title';

    public  function subtitle()
    {
        return 'Song';
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'title',
        'id',
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
            Tabs::make('Song', [
                Tab::make('Details',
                    [
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
                        Text::make('Title')
                            ->rules(['required']),
                        Tags::make('Tags')
                            ->hideFromIndex(),
                        Text::make('Genre', fn () => optional($this->genre)->name)
                            ->exceptOnForms(),
                        Select::make('Genre', 'genre_id')
                            ->onlyOnForms()
                            ->options(
                                Genre::whereType(Genre::TYPE_SONG)
                                    ->get()
                                    ->pluck('name', 'id')
                            )->rules(['required']),
                        Textarea::make('Description')
                            ->help('maximum of 1000 characters.')
                            ->alwaysShow()
                            ->rules(['required', 'max:1000']),
                        Textarea::make('Credits', 'credit')
                            ->alwaysShow()
                            ->rules(['max:1000'])
                            ->help('maximum of 1000 characters.'),
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
                        Trix::make('Lyrics')
                            ->alwaysShow()
                            ->rules(['max:2500']),
                        Textarea::make('Copyright')
                            ->alwaysShow()
                            ->rules(['max:1000']),
                        Boolean::make('Not yet copyrighted'),
                     ]
                ),
                MorphOne::make('Cover', 'cover', Cover::class),
                MorphOne::make('Upload Song', 'largeFile', LargeMedia::class),
                Tab::make('Publish', [
                    Date::make('Published Date', 'published_at')
                        ->exceptOnForms(),
                ]),
            ])->withToolbar()
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
