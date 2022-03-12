<?php

namespace App\Nova;

use App\Rules\ShouldChecked;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Date;
use Elezerk\LargeFile\LargeFile;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Http\Requests\NovaRequest;

class LargeMedia extends Media
{
    public static $model = \App\Models\File::class;

    public static function label() {
        return 'File';
    }

    public static function availableForNavigation(Request $request)
    {
        return auth()->user()->hasRole(\App\Models\Role::SUPERADMIN);
    }

    public function fields(Request $request)
    {
        return [
            Date::make('Date Uploaded', 'created_at')
                ->exceptOnForms(),
            LargeFile::make('File', 'path')
                ->rules(['required']),
            Boolean::make('Copyright Disclaimer')
                ->help(nova_get_setting('copyright_disclaimer'))
                ->rules(['required', (new ShouldChecked)]),
        ];
    }
}
