<?php

namespace App\Nova;

use App\Rules\ShouldChecked;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Boolean;
use Illuminate\Http\Request;

class Cover extends Media
{
    public static function createButtonLabel()
    {
        return 'Upload Cover';
    }

    public function fields(Request $request)
    {
        return [
            Date::make('Date Uploaded', 'created_at')
                ->exceptOnForms(),
            Image::make('Cover', 'path')
                ->rules('required', 'image', 'max:10000'), // maximum of 10 mb
            Boolean::make('Copyright Disclaimer')
                ->hideFromIndex()
                ->help(nova_get_setting('copyright_disclaimer'))
                ->rules(['required', (new ShouldChecked)]),
        ];
    }
}
