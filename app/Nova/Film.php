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
use App\Helpers\CrystalHelper;
use App\Nova\Actions\SendEmail;
use Laravel\Nova\Fields\Hidden;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use App\Nova\Actions\PublishWork;
use Laravel\Nova\Fields\MorphOne;
use Laravel\Nova\Fields\Textarea;
use App\Models\Film as ModelsFilm;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\MorphMany;
use App\Nova\Actions\RequestToPublish;
use App\Nova\Traits\ForUserIndividualOnly;
use Laravel\Nova\Http\Requests\NovaRequest;

class Film extends Resource
{
    use ForUserIndividualOnly;
    public static $group = "Works";
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Film::class;

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

    public function subtitle()
    {
        return 'Film';
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
            Tabs::make('Film', [
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
                    Text::make('Title')
                        ->rules(['required']),
                    Select::make('Type')
                        ->options([
                            ModelsFilm::TYPE_ANIMATION => ModelsFilm::TYPE_ANIMATION,
                            ModelsFilm::TYPE_FILM => ModelsFilm::TYPE_FILM,
                            ModelsFilm::TYPE_TRAILER => ModelsFilm::TYPE_TRAILER,
                        ])
                        ->rules(['required']),
                    Text::make('Genre', fn () => $this->genre->name)
                        ->exceptOnForms(),
                    Select::make('Genre', 'genre_id')
                        ->onlyOnForms()
                        ->options(
                            Genre::whereType(Genre::TYPE_VIDEO)
                                ->get()
                                ->pluck('name', 'id')
                        )->rules(['required']),
                    Number::make('Age Restriction')
                        ->nullable()
                        ->help('for X And Above only.'),
                    BelongsTo::make('Language', 'language', Language::class),
                    Textarea::make('Description')
                        ->alwaysShow()
                        ->rules(['required']),
                    Textarea::make('Credits', 'credit')
                        ->alwaysShow()
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
                ]),
                MorphOne::make('Cover', 'cover', Cover::class),
                MorphOne::make('Upload Film', 'largeFile', LargeMedia::class),
                Tab::make('Publish', [
                    Date::make('Published Date', 'published_at')
                        ->exceptOnForms(),
                ]),
            ])->withToolbar(),
            //relations
            MorphMany::make('Free Art Scenes', 'freeArtScenes', FreeArtScene::class),
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
