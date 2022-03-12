<?php

namespace App\Nova\Traits;

use Illuminate\Http\Request;

trait CannotCreateOrUpdate
{
    public static function authorizedToCreate(Request $request)
    {
        return false;
    }

    public function authorizedToUpdate(Request $request)
    {
        if ($request->has('action')) {
            return true;
        }
        return false;
    }
}
