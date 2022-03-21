<?php

namespace App\Http\Controllers\Scholar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
         $model = $request->model;
         $keyword = $request->keyword;
         $view = $request->view;
         $result = ("\\App\\Models\\" . $model)::whereUserId(auth()->id())->where('title', 'LIKE', "%" . $keyword ."%")->get();
         return view($view, [$request->data => $result]);
    }
}
