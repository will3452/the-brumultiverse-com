<?php

namespace App\Nova;

use App\Models\Role;
use App\Models\User;
use App\Models\Genre;
use App\Models\Level;
use App\Models\Account;
use App\Models\College;
use Eminiarts\Tabs\Tab;
use App\Models\Category;
use Eminiarts\Tabs\Tabs;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use App\Models\ViolenceLevel;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Fields\Text;
use App\Helpers\CrystalHelper;
use Laravel\Nova\Fields\Image;
use App\Nova\Actions\SendEmail;
use Laravel\Nova\Fields\Hidden;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\MorphOne;
use Laravel\Nova\Fields\Textarea;
use PalauaAndSons\TagsField\Tags;
use App\Models\Book as ModelsBook;
use App\Nova\Actions\PublishWork;
use App\Nova\Actions\RequestToPublish;
use App\Nova\Actions\SetHeatLevel;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\MorphMany;
use App\Nova\Actions\SetViolenceLevel;
use App\Nova\Traits\ForUserIndividualOnly;
use Laravel\Nova\Http\Requests\NovaRequest;
use Hubertnnn\LaravelNova\Fields\DynamicSelect\DynamicSelect;

class Book extends Resource
{
    use ForUserIndividualOnly;
    public static $group = "Works";
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Book::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'title';

    public  function subtitle()
    {
        return 'Book';
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
            Tabs::make('Book', [
                Tab::make('Details', [
                    Select::make('Book Type', 'type')
                        ->options([
                            ModelsBook::TYPE_REGULAR => ModelsBook::TYPE_REGULAR,
                            ModelsBook::TYPE_PREMIUM => ModelsBook::TYPE_PREMIUM,
                            ModelsBook::TYPE_SPIN => ModelsBook::TYPE_SPIN,
                            ModelsBook::TYPE_EVENT => ModelsBook::TYPE_EVENT,
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
                    Number::make('Age Restriction')
                        ->nullable()
                        ->help('for X And Above only.'),
                    Boolean::make('Has warning message'),
                    Text::make('Category', fn () => $this->category->name)
                        ->exceptOnForms(),
                    Select::make('Category', 'category_id')
                        ->onlyOnForms()
                        ->options(
                            Category::whereWorkType(
                                Category::WORK_TYPE_BOOK
                            )->get()->pluck('name', 'id')
                        )->rules(['required']),
                    Tags::make('Tags')
                        ->hideFromIndex(),
                    Text::make('Genre', fn () => $this->genre->name)
                        ->exceptOnForms(),
                    Select::make('Genre', 'genre_id')
                        ->onlyOnForms()
                        ->options(
                            Genre::whereType(Genre::TYPE_TEXT)
                                ->get()
                                ->pluck('name', 'id')
                        )->rules(['required']),
                    BelongsTo::make('Heat Level', 'heatLevel', \App\Nova\Level::class)
                        ->exceptOnForms(),
                    BelongsTo::make('Violence Level', 'violenceLevel', \App\Nova\Level::class)
                        ->exceptOnForms(),
                    BelongsTo::make('Language', 'language', Language::class),
                    Textarea::make('Blurb')
                        ->alwaysShow()
                        ->rules(['required', 'max:1000'])
                        ->help('maximum of 1000 characters.'),
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
                    Select::make('Lead College')
                        ->options(College::get()->pluck('name', 'name'))
                        ->rules(['required']),
                    Select::make('Lead Character')
                        ->options([
                            User::GENDER_FEMALE => User::GENDER_FEMALE,
                            User::GENDER_MALE => User::GENDER_MALE,
                            User::GENDER_LGBT => User::GENDER_LGBT,
                        ]),
                    File::make('PDF', 'front_matter')
                        ->help('Title, Copyright, Acknowledgements and Dedication pages.'),
                    // File::make('Back Matter'),
                ]),
                //relationship here
                MorphOne::make('Cover', 'cover', Cover::class),
                MorphMany::make('Chapters', 'chapters', Chapter::class),
                Tab::make('Publish', [
                    Date::make('Published Date', 'published_at')
                        ->exceptOnForms(),
                ]),

            ])->withToolbar(),
            MorphOne::make('Prologue', 'prologue', Prologue::class),
            MorphOne::make('Epilogue', 'epilogue', Epilogue::class),
            MorphMany::make('Review Question', 'reviewQuestions', ReviewQuestion::class),
            MorphMany::make('Free Art Scene', 'freeArtScenes', FreeArtScene::class),
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
        $actions = [
            (new SetHeatLevel($this))
                ->canSee(fn () => ! $this->heatLevel),

            (new SetViolenceLevel($this))
                ->canSee(fn () => ! $this->violenceLevel),

            (new SendEmail)
                ->canSee(fn () => auth()->user()->hasRole(Role::SUPERADMIN)),

            (new RequestToPublish)
                ->onlyOnDetail(),

            (new PublishWork)
                ->canSee(fn () => auth()->user()->hasRole(Role::SUPERADMIN)),
        ];

        return $actions;
    }
}
