<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Http\Requests\NovaRequest;

class PendingAccount extends Account
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\PendingAccount::class;

    public static $group = "approvals";

    public static function authorizedToCreate(Request $request)
    {
        return false;
    }

    public function cards(Request $request)
    {
        return [];
    }

}
