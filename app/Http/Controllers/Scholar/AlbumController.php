<?php

namespace App\Http\Controllers\Scholar;

use App\Http\Controllers\Controller;
use App\Models\Album;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    public function index()
    {
        $albums = auth()->user()->albums ?? [];


        return view('scholar.album.index', compact('albums'));
    }

    public function show(Album $album)
    {
        $optionWorks = [];
        $works = $album->works;
        if ($album->type === Album::TYPE_ART_SCENE) {
            $optionWorks = auth()->user()->artScenes()->whereNotIn('id', $works->pluck('work_id'))->get();
        }
        if ($album->type === Album::TYPE_SONG) {
            $optionWorks = auth()->user()->songs()->whereNotIn('id', $works->pluck('work_id'))->get();
        }

        return view('scholar.album.show', compact('album', 'optionWorks', 'works'));
    }

    public function create()
    {
        $accounts = auth()->user()->accounts()->whereNotNull('approved_at')->get();
        return view('scholar.album.create', compact('accounts'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required'],
            'account_id' => ['required', 'exists:accounts,id'],
            'type' => ['required'],
            'description' => ['required'],
            'credit' => ['required'],
        ]);

        $data['user_id'] = auth()->user()->id;

        $album = Album::create($data);
        return redirect(route('scholars.album.show', ['album' => $album]))->withSuccess('Album created!');
    }
}
