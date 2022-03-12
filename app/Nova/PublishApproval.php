<?php

namespace App\Nova;

use App\Models\Role;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Fields\MorphTo;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Http\Requests\NovaRequest;
use App\Models\PublishApproval as ModelsPublishApproval;
use App\Nova\Actions\SendEmail;
use App\Nova\Filters\PublishApproval\Status;
use App\Nova\Traits\ForUserIndividualOnly;
use Laravel\Nova\Fields\DateTime;

class PublishApproval extends Resource
{
    use ForUserIndividualOnly;

    public static $group = "approvals";

    public static function authorizedToCreate(Request $request)
    {
        return false;
    }

    public function authorizedToUpdate(Request $request)
    {
        if ($request->has('action') || auth()->user()->hasRole(Role::SUPERADMIN)) {
            return true;
        }
        return false;
    }
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\PublishApproval::class;

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
        'created_at',
        'notes',
        'model_type',
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
            Date::make('Date', 'created_at')
                ->exceptOnForms()
                ->sortable(),
            Badge::make('Status')
                ->map([
                    ModelsPublishApproval::STATUS_APPROVED => 'success',
                    ModelsPublishApproval::STATUS_PENDING => 'warning',
                    ModelsPublishApproval::STATUS_DECLINED => 'danger',
                ]),
            MorphTo::make('Work', 'model'),
            Textarea::make('Notes')
                ->help('Maximum of 500 characters only.')
                ->rules(['required', 'max:500']),
            BelongsTo::make('Account', 'account', \App\Nova\Account::class)
                ->hideWhenCreating()
                ->hideWhenUpdating(),

            BelongsTo::make('Approved By', 'approvedByUser', \App\Nova\User::class)
                ->hideWhenCreating()
                ->hideWhenUpdating(),

            DateTime::make('Approved At')
                ->exceptOnForms()
                ->sortable(),
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
        return [
            (new Status),
        ];
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
