<?php

namespace App\Http\Controllers\Scholar;

use App\Helpers\FileHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Preview;

class PreviewController extends Controller
{
    public function upload(Request $request)
    {
        $data = $request->validate([
            'mediable_id' => 'required',
            'mediable_type' => 'required',
            'file' => 'required',
        ]);

        $data['path'] = FileHelper::filepondSave($request->file);
        unset($data['file']);
        $data['copyright_disclaimer'] = true;
        Preview::create($data);
        return back()->withSuccess('Uploaded!');
    }
}
