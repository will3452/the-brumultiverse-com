<?php

namespace App\Nova;

use App\Models\Account;
use App\Models\GroupType;
use App\Nova\Actions\Group\Ban;
use DateTime;
use Eminiarts\Tabs\Tab;
use Eminiarts\Tabs\Tabs;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Hidden;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\DateTime as FieldsDateTime;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use Pdmfc\NovaCards\Info;

class Group extends Resource
{
    public static function indexQuery(NovaRequest $request, $query)
    {
        if (auth()->user()->isAdmin()) {
            return $query;
        }
        $groupIds = auth()->user()->groups()->pluck('group_id')->toArray();
        return $query->whereIn('id', $groupIds);
    }

    public function authorizedToUpdate(Request $request)
    {
        if (auth()->user()->isAdmin()) {
            return true;
        }
        $user = auth()->user();
        return $user->can('update group') && $this->isGroupCreator($user);
    }

    public static $group = 'user Management';
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Group::class;

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
        'name',
        'type',
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
            Tabs::make('Group', [
                Tab::make('Details',[
                    Date::make('Date', 'created_at')
                        ->sortable()
                        ->exceptOnForms(),
                    BelongsTo::make('Group Creator', 'account', \App\Nova\Account::class)
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
                    Text::make('Name')
                        ->sortable()
                        ->rules(['required', 'unique:groups,name,{{resourceId}}']),
                    Select::make('Type')
                        ->options(GroupType::get()->pluck('description', 'description'))
                        ->rules(['required']),
                    Textarea::make('Description')
                        ->alwaysShow()
                        ->help('maximum of 500 characters only.')
                        ->rules(['required', 'max:500']),
                    Text::make('Status')
                        ->exceptOnForms(),
                    FieldsDateTime::make('Approved At')
                        ->exceptOnForms(),
                    BelongsTo::make('Approver', 'approver', User::class)
                        ->exceptOnForms(),
                        ]),
                HasMany::make('Members', 'members', GroupMember::class),
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
        return [
            (new Info())
                ->info('The group to be created will be reviewed and approved by the Administrator.')
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
        $actions = [
            (new Ban),
        ];

        if (auth()->user()->isAdmin()) {
            return $actions;
        }

        // if not admin
        return [];
    }
}
