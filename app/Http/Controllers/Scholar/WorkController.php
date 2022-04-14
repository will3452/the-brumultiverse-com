<?php

namespace App\Http\Controllers\Scholar;

use App\Http\Controllers\Controller;
use App\Models\ClassWork;
use Illuminate\Http\Request;

class WorkController extends Controller
{
    public function addWork(Request $request)
    {
        $data = $request->validate([
            'class_type' => 'required',
            'class_id' => 'required',
            'work_id' => 'required',
            'work_type' => 'required',
        ]);

        ClassWork::create($data);

        return back()->withSuccess('Work has been added!');
    }
}
