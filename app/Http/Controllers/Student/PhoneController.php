<?php

namespace App\Http\Controllers\Student;

use App\Models\User;
use App\Models\ArtScene;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\StudentCollection;

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

    public function contactList(Request $request) {
        $friends = [];
        $requests = [];
        if($request->has('filter') && $request->filter == 'request') {
            $requests = auth()->user()->getFriendRequests();
        } else {
            $friends = auth()->user()->getFriends();
        }
        return view('student.phone.contact_list', compact('friends', 'requests'));
    }

    public function acceptFriendRequest(User $user) {
        auth()->user()->acceptFriendRequest($user);
        toast('Success');
        return back();
    }
}
