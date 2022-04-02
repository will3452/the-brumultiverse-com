<?php

namespace App\Http\Controllers\Scholar;

use App\Events\MarketingHasBeenSaved;
use App\Events\MarketingSaved;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MarketingController extends Controller
{
    public function save(Request $request)
    {
        $type = $request->type;
        $id = $request->id;
        $marketing = ("\\App\\Models\\$type")::find($id);
        $marketing->saveNow();
        event(new MarketingSaved($marketing));
        return back()->withSuccess('Saved!');
    }
}
