<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function submitComment (Request $request) {
        $data = $request->validate([
            'model_type' => ['required'],
            'model_id' => ['required'],
            'text' => ['required'],
        ]);

        $data['user_id'] = auth()->id();

        Comment::create($data);

        toast('comment has been submitted!');

        return back();
    }
}
