<?php

namespace App\Http\Controllers\Scholar;

use App\Models\Genre;
use App\Models\Level;
use App\Models\Account;
use App\Models\College;
use App\Models\Category;
use App\Models\Language;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AudioBook;

class AudioBookController extends Controller
{
    public function customValidate(Request $request)
    {
        $request->validate([
            // 'type' => 'required',
            'title' => 'required',
            'category' => 'required',
            'account' => 'required',
            'genre' => 'required',
            'has_warning_message' => 'boolean',
            'tags' => 'required',
            'language' => 'required',
            'lead_character' => 'required',
            'lead_college' => 'required',
            'blurb' => 'required',
            'cost' => ['numeric', 'gte:0'],
            'credit' => 'required',
            'cover' => ['image','max:2000'],
            'violence_level' => '',
            'heat_level' => '',
        ]);
    }


    public function index()
    {
        $audioBooks = auth()->user()->audioBooks;
        $accounts = auth()->user()->accounts()->whereNotNull('approved_at')->whereHas('audioBooks')->get();
        return view('scholar.audio-book.index', compact('audioBooks', 'accounts'));
    }

    public function getData()
    {
        return [
            Category::forAudioBook(),
            Account::getApprovedAccountsFor(auth()->id()),
            Genre::forBook(),
            Language::get()->pluck('name', 'id'),
            College::get()->pluck('name', 'name'),
        ];
    }

    public function create(Request $request)
    {
        $book = null;
        $heatLevel = Level::whereType(Level::TYPE_HEAT)->get();
        $violenceLevel = Level::whereType(Level::TYPE_VIOLENCE)->get();
        [$categories, $accounts, $genres, $languages, $colleges] = $this->getData();

        if ($request->has('book')) {
            $book = auth()->user()->books()->where('title', 'LIKE', "%".$request->book."%")->first();
        }

        return view('scholar.audio-book.create', compact('categories', 'accounts', 'genres', 'languages', 'colleges', 'heatLevel', 'violenceLevel', 'book'));
    }

    public function store(Request $request)
    {
        $this->customValidate($request);
        $audioBook = AudioBook::processToCreate($request);
        return redirect(route('scholars.audiobook.show', ['audio' => $audioBook->id]))->withSuccess('Success');
    }

    public function show(Request $request, AudioBook $audio)
    {
        [$categories, $accounts, $genres, $languages, $colleges] = $this->getData();
        return view('scholar.audio-book.show', compact('audio', 'categories', 'accounts', 'genres', 'languages', 'colleges'));
    }

    public function update(Request $request, AudioBook $audio)
    {
        AudioBook::processToUpdate($request, $audio);

        return back()->withSuccess('success!');
    }
}
