<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\User;
use App\Rules\ConversationMustNotAvailable;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function __construct()
    {
        return $this->middleware(['auth.basic']);
    }

    public function index(Chat $chat)
    {
        $chats = auth()->user()->chats()->orderBy('updated_at', 'DESC')->get();
        return view('chat.index', compact('chats', 'chat'));
    }

    // public function show(Chat $chat)
    // {
    //     return view('chat.index', compact('chat'));
    // }

    public function create()
    {
        $users = User::where('id', '!=', auth()->id())->get(); // get the user except his/her id
        return view('chat.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => ['required', new ConversationMustNotAvailable()],
        ]);

        $user = User::find($request->user_id);
        $chat = Chat::create(['name' =>  Chat::createName(auth()->user()->user_name, $user->user_name)]);
        $chat->users()->attach([$user->id, auth()->id()]);
        return redirect()->to('/chats/' . $chat->id);
    }

    public function createMessage(Request $request, Chat $chat)
    {
        $request->validate([
            'message' => 'required',
        ]);

        $message = $chat->messages()->create(['message'=> $request->message, 'user_id' => auth()->id()]);
        //just to take on top
        $chat->updated_at = now();
        $chat->save();
        return $message;
    }
}
