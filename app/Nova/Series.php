<?php

namespace App\Nova;

use App\Models\Role;
use App\Models\Account;
use Eminiarts\Tabs\Tab;
use Eminiarts\Tabs\Tabs;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use App\Nova\Actions\AddWork;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Text;
use App\Nova\Actions\SendEmail;
use Laravel\Nova\Fields\Hidden;
use Laravel\Nova\Fields\Select;
use App\Nova\Actions\PublishWork;
use Laravel\Nova\Fields\MorphOne;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\MorphMany;
use App\Models\Series as ModelsSeries;
use App\Nova\Actions\RequestToPublish;
use App\Nova\Traits\ForUserIndividualOnly;
use Laravel\Nova\Http\Requests\NovaRequest;

class Series extends Resource
{
    use ForUserIndividualOnly;

    public static $group = "Collections";
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Series::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

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
            Tabs::make('Series',[
                Tab::make('Details', [
                    Select::make('Type')
                    ->options([
                        ModelsSeries::TYPE_AUDIO_BOOK => ModelsSeries::TYPE_AUDIO_BOOK,
                        ModelsSeries::TYPE_BOOK => ModelsSeries::TYPE_BOOK,
                        ModelsSeries::TYPE_FILM => ModelsSeries::TYPE_FILM,
                        ModelsSeries::TYPE_PODCAST => ModelsSeries::TYPE_PODCAST,
                    ])
                    ->rules(['required']),
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
                    Textarea::make('Description')
                            ->alwaysShow()
                            ->rules(['required']),
                    Textarea::make('Credits', 'credit')
                            ->alwaysShow()
                            ->rules(['required']),
                    ]),
                    MorphOne::make('Cover', 'cover', Cover::class),
                    Tab::make('Publish', [
                        Date::make('Published Date', 'published_at')
                            ->exceptOnForms(),
                    ]),
            ])->withToolbar(),
            MorphMany::make("Works", 'works', ClassWork::class),
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
        $currentModel = (self::$model)::find($request->resourceId);
        return [
            (new AddWork($currentModel->type ?? "Book"))
                ->onlyOnDetail(),
            (new SendEmail)
                ->canSee(fn () => auth()->user()->hasRole(Role::SUPERADMIN)),

            (new RequestToPublish),

            (new PublishWork)
                ->canSee(fn () => auth()->user()->hasRole(Role::SUPERADMIN)),
        ];
    }
}
