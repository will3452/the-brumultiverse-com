<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\User;
use Illuminate\Http\Request;
use App\Rules\ConversationMustNotAvailable;

class Chat1Controller extends Controller
{

    public function index (Chat $chat) {
        $chats = auth()->user()->chats()->orderBy('updated_at', 'DESC')->get();
        return view('chat1.index', compact('chats', 'chat'));
    }

    public function create () {
        $users = User::where('id', '!=', auth()->id())->get();
        return view('chat1.create', compact('users'));
    }

    public function createMessage(Request $request, Chat $chat)
    {
        $request->validate([
            'message' => 'required',
        ]);

        $message = $chat->messages()->create(['message'=> trim($request->message), 'user_id' => auth()->id()]);
        //to take on top
        $chat->updated_at = now();
        $chat->save();
        return redirect()->to(route('chat.1.index', ['chat' => $chat]) . '#last')->withSuccess('message sent!');
    }

    public function store (Request $request) {

        $data = $request->validate([
            'user_id' => ['required', new ConversationMustNotAvailable()],
            'message' => ['required', 'max:500'],
        ]);

        $user = User::find($request->user_id);
        $chat = Chat::create(['name' =>  Chat::createName(auth()->user()->user_name, $user->user_name)]);
        $chat->users()->attach([$user->id, auth()->id()]);
        //create first message
        $chat->messages()->create(['message'=> $request->message, 'user_id' => auth()->id()]);
        $chat->updated_at = now();
        $chat->save();
        return redirect()->to(route('chat.1.index', ['chat' => $chat]));
    }
}
