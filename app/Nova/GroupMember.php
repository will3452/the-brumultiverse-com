<?php

namespace App\Nova;

use App\Models\GroupMember as ModelsGroupMember;
use App\Rules\AccountIsNotYetIncluded;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Hidden;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class GroupMember extends Resource
{
    public static $displayInNavigation = false;

    public static function createButtonLabel()
    {
        return "Add New Member";
    }

    public function authorizedToDelete(Request $request)
    {
        $isTheCreator = $this->group->isGroupCreator(auth()->user());
        return auth()->user()->isAdmin() || $isTheCreator;
    }
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\GroupMember::class;

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
        // 'account_id',
        // 'position'
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        $group = \App\Models\Group::find($request->viaResourceId ?? $this->group_id);
        return [
            BelongsTo::make('Group', 'group', Group::class)
                ->hideFromIndex(),
            Text::make('Account', fn()=>optional($this->member)->penname)
                ->exceptOnForms(),
            Select::make('Account', 'account_member_id')
                ->onlyOnForms()
                ->options(\App\Models\Account::whereNotNull('approved_at')->get()->pluck('penname', 'id'))
                ->searchable()
                ->rules(['required', (new AccountIsNotYetIncluded($group))]),
            Text::make('Remarks')
                ->exceptOnForms(),
            Text::make('Position'),
            Badge::make('Status')
                ->map([
                    ModelsGroupMember::STATUS_CONFIRMED => 'success',
                    ModelsGroupMember::STATUS_DECLINED => 'danger',
                    ModelsGroupMember::STATUS_PENDING => 'info'
                ]),
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
