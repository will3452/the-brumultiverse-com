<?php

namespace App\Http\Controllers\Scholar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FreeArtSceneController extends Controller
{
    public function addFreeArtScene(Request $request)
    {
        $data = $request->validate([
            'type' => 'required',
            'id' => 'required',
            'art_scene_id' => 'required',
        ]);
        $type = $data['type'];
        $model = ("\\App\\Models\\$type")::findOrFail($data['id']);
        $model->freeArtScenes()->create([
            'art_scene_id' => $data['art_scene_id']
        ]);
        return back()->withSuccess('Added!');
    }
}
