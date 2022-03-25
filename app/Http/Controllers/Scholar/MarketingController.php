<?php

namespace App\Http\Controllers\Scholar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MarketingController extends Controller
{
    public function save(Request $request)
    {
        $type = $request->type;
        $id = $request->id;
        ("\\App\\Models\\$type")::find($id)->saveNow();

        return back()->withSuccess('Saved!');
    }
}
