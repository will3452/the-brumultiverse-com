<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentCollectionController extends Controller
{
    public function addToCollection ($type, $id) {
        auth()->user()->studentCollections()->create(['model_type' => getFullModel($type), 'model_id' => $id]);

        return back()->withSuccess('work has been added to your collection!');
    }
}
