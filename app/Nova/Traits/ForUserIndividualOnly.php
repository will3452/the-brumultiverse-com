<?php

namespace App\Nova\Traits;

use App\Models\Role;
use Laravel\Nova\Http\Requests\NovaRequest;

trait ForUserIndividualOnly
{
    public static function indexQuery(NovaRequest $request, $query)
    {
        if (! auth()->user()->hasRole(Role::SUPERADMIN)) {
            return $query->whereUserId(auth()->id());
        }
        return $query;
    }
}
