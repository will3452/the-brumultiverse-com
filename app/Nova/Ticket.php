<?php

namespace App\Nova;

use App\Nova\User;
use App\Models\Account;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Fields\Hidden;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\MorphTo;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\BelongsTo;
use App\Nova\Actions\Ticket\Approve;
use App\Models\Ticket as ModelsTicket;
use App\Nova\Traits\CannotCreateOrUpdate;
use Laravel\Nova\Http\Requests\NovaRequest;

class Ticket extends Resource
{
    // use CannotCreateOrUpdate;
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Ticket::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'created_at';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'created_at',
        'action',
        'status',
        'requestor_notes',
        'approver_notes',
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
            Date::make('Date Submitted', 'created_at')
                ->sortable()
                ->exceptOnForms(),
            BelongsTo::make('Account', 'account', \App\Nova\Account::class)
                ->hideWhenCreating()
                ->hideWhenUpdating(),
            Select::make('Account', 'account_id')
                ->onlyOnForms()
                ->options( Account::whereUserId(auth()->id())
                        ->whereNotNull('approved_at')
                        ->get()
                        ->pluck('penname', 'id')
                    )->rules(['required']),
            Hidden::make('user_id')
                ->default(fn () => auth()->id()),
            MorphTo::make('Subject', 'model'),
            Badge::make('Action')
                ->map([
                    ModelsTicket::ACTION_UPDATE => 'info',
                    ModelsTicket::ACTION_DELETE => 'danger',
                ]),
            Badge::make('Status')
                ->map([
                    ModelsTicket::STATUS_DECLINED => 'danger',
                    ModelsTicket::STATUS_PENDING => 'info',
                    ModelsTicket::STATUS_APPROVED => 'success',
                ]),
            Text::make('Original Details', function () {
                if ($this->action == \App\Models\Ticket::ACTION_DELETE) {
                    return;
                }
                $data = json_decode($this->old_state, true);
                $str = "<table class='table p-2'>";
                foreach ($data as $key=>$val) {
                    if ($key === 'requestor_notes') continue;
                    $str .= "<tr><th class='border'>$key</th><td class='border'>$val</td></tr>";
                }
                $str .= "</table>";
                return $str;
            })->onlyOnDetail()
                ->asHtml(),
            Text::make('New Details', function () {
                if ($this->action == \App\Models\Ticket::ACTION_DELETE) {
                    return;
                }
                $data = json_decode($this->new_state, true);
                $str = "<table class='table p-2'>";
                foreach ($data as $key=>$val) {
                    if ($key === 'requestor_notes') continue;
                    $str .= "<tr><th class='border'>$key</th><td class='border'>$val</td></tr>";
                }
                $str .= "</table>";
                return $str;
            })->onlyOnDetail()
                ->asHtml(),
            Textarea::make('Author Notes', 'requestor_notes')
                ->onlyOnDetail(),
            DateTime::make('Approved At'),
            BelongsTo::make('Approver', 'approver', User::class),
            Textarea::make('Approver Notes'),
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
            (new Approve)
        ];
    }
}
