<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\StudentCollection;
use App\Models\ArtScene;
use Illuminate\Http\Request;

class PhoneController extends Controller
{
    use StudentCollection;

    public function getModel () {
        return ArtScene::class;
    }

    public function index (Request $request)
    {
        return view('student.phone.index');
    }

    public function photo (Request $request)
    {
        $works = [];
        if ($request->has('search') && $request->search != '') {
            $works = ArtScene::whereIn('id', $this->myWorkCollection())->where('title', 'LIKE', '%'.$request->search.'%')->get();
        } else {
            $works = $this->getWorks();
        }
        return view('student.phone.images', compact('works'));
    }

    public function viewPhoto(Request $request, $path)
    {
        return view('student.phone.image_view', compact('path'));
    }
}
