<?php

namespace App\Http\Controllers\Scholar;

use App\Models\Genre;
use App\Models\Account;
use App\Models\College;
use App\Models\Language;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ArtScene;

class ArtSceneController extends Controller
{

    public function customValidate(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'account' => 'required',
            'genre' => 'required',
            'tags' => 'required',
            'lead_character' => 'required',
            'lead_college' => 'required',
            'description' => 'required',
            'cost' => ['numeric', 'gte:0'],
            'credit' => 'required'
        ]);
    }

    public function getData()
    {
        return [
            Account::getApprovedAccountsFor(auth()->id()),
            Genre::forArtScene(),
            College::get()->pluck('name', 'name'),
        ];
    }

    public function index()
    {
        $artScenes = auth()->user()->artScenes;
        return view('scholar.art-scene.index', compact('artScenes'));
    }

    public function create()
    {
        [$accounts, $genres, $colleges] = $this->getData();
        return view('scholar.art-scene.create', compact('accounts', 'genres', 'colleges'));
    }


    public function store(Request $request)
    {
        $this->customValidate($request);
        $artScene = ArtScene::processToCreate($request);
        return redirect(route('scholar.artscene.show', ['art' => $artScene->id]))->withSuccess('Success');
    }

    public function show(Request $request, ArtScene $art)
    {
        $artScene = $art;
        [$accounts, $genres, $colleges] = $this->getData();
        return view('scholar.art-scene.show', compact('artScene', 'accounts', 'genres', 'colleges'));
    }

    public function update(Request $request, ArtScene $art)
    {
        ArtScene::processToUpdate($request, $art);
        return back()->withSuccess('success!');
    }
}
