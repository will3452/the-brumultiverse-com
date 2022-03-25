<?php

namespace App\Http\Controllers\Scholar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AnnexController extends Controller
{
    public function __construct()
    {
        return $this->middleware(['auth']);
    }

    public function getAnnex(Request $request)
    {
        $model = ("\\App\\Models\\$request->type")::find($request->id);
        return view('scholar.annex', compact('model'));
    }
}
