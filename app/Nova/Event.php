<?php

namespace App\Nova;

use App\Models\Account;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use App\Helpers\CrystalHelper;
use App\Models\Event as ModelsEvent;
use App\Nova\Actions\Event\RequestForApproval;
use Laravel\Nova\Fields\Hidden;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\BelongsTo;
use App\Nova\Traits\ForUserIndividualOnly;
use App\Rules\DateShouldAtLease;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Http\Requests\NovaRequest;

class Event extends Resource
{
    use ForUserIndividualOnly;
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Event::class;

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
                ->rules(['required', 'unique:events,title,{{resourceId}}']),
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
            Select::make('Type')
                ->options([
                    ModelsEvent::TYPE_SOLO => ModelsEvent::TYPE_SOLO,
                    ModelsEvent::TYPE_GROUP => ModelsEvent::TYPE_GROUP,
                ]),
            Date::make('Start', 'start_date')
                ->help('Event should at least be ' . nova_get_setting('event_day_away', 60) . 'days away.')
                ->rules(['required', (new DateShouldAtLease(nova_get_setting('event_day_away', 60), "Event should at least be " . nova_get_setting('event_day_away', 60) . " days away."))]),
            Date::make('End', 'end_date')
                ->rules(['required', 'after:start_date']),
            Badge::make('Status')
                ->map([
                    ModelsEvent::STATUS_DRAFT => 'info',
                    ModelsEvent::STATUS_FOR_APPROVAL => 'info',
                    ModelsEvent::STATUS_APPROVED => 'success',
                    ModelsEvent::STATUS_DECLINED => 'danger',
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
        return [
            (new RequestForApproval),
        ];
    }
}
