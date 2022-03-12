<?php

namespace App\Nova;

use App\Nova\Actions\Group\Approve;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Http\Requests\NovaRequest;

class PendingGroup extends Group
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\PendingGroup::class;

    public static $group = "approvals";

    public static function authorizedToCreate(Request $request)
    {
        return false;
    }

    public function actions(Request $request)
    {
        $actions = [
            (new Approve),
        ];

        if (auth()->user()->isAdmin()) {
            return $actions;
        }

        return [];
    }
}
