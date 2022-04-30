<?php

namespace App\Http\Controllers\Scholar;

use App\Models\Genre;
use App\Models\Account;
use App\Models\Language;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Film;

class FilmController extends Controller
{
    public function customValidate(Request $request)
    {
        $request->validate([
            'type' => 'required',
            'title' => 'required',
            'account' => 'required',
            'genre' => '',
            'tags' => 'required',
            'language' => 'required',
            'description' => 'required',
            'cost_type' => '',
            'cost' => ['numeric', 'gte:0'],
            'credit' => 'required',
            'cover' => ['image','max:2000'],
        ]);
    }


    public function getData()
    {
        return [
            Account::getApprovedAccountsFor(auth()->id()),
            Genre::forFilm(),
            Language::get()->pluck('name', 'id'),
        ];
    }

    public function index()
    {
        $films = auth()->user()->films;
        $accounts = auth()->user()->accounts()->whereNotNull('approved_at')->whereHas('films')->get();
        return view('scholar.film.index', compact('films', 'accounts'));
    }

    public function create()
    {
        [$accounts, $genres, $languages] = $this->getData();
        return view('scholar.film.create', compact('accounts', 'genres', 'languages'));
    }

    public function store(Request $request)
    {
        $this->customValidate($request);
        $film = Film::processToCreate($request);
        return redirect(route('scholar.film.show', ['film' => $film]))->withSuccess('Success');
    }

    public function show(Request $request, Film $film)
    {
        [$accounts, $genres, $languages] = $this->getData();
        return view('scholar.film.show', compact('accounts', 'genres', 'languages', 'film'));
    }

    public function update(Request $request, Film $film)
    {
        Film::processToUpdate($request, $film);

        return back()->withSuccess('Success');
    }
}
