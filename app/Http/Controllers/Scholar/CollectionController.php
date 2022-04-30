<?php

namespace App\Http\Controllers\Scholar;

use App\Http\Controllers\Controller;
use App\Models\Collection;
use Illuminate\Http\Request;

class CollectionController extends Controller
{
    public function index()
    {
        $collections = auth()->user()->collections ?? [];

        return view('scholar.collection.index', compact('collections'));
    }

    public function show(Collection $collection)
    {
        $works = $collection->works;

        $optionWorks = $collection->getOptionWorks($works->pluck('work_id'));

        return view('scholar.collection.show', compact('collection', 'optionWorks', 'works'));
    }

    public function create()
    {
        $accounts = auth()->user()->accounts()->whereNotNull('approved_at')->get();
        return view('scholar.collection.create', compact('accounts'));
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

        $collection = Collection::create($data);
        return redirect(route('scholars.collection.show', ['collection' => $collection]))->withSuccess('Collection created!');
    }
}
