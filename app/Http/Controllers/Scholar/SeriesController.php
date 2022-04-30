<?php

namespace App\Http\Controllers\Scholar;

use App\Http\Controllers\Controller;
use App\Models\Series;
use Illuminate\Http\Request;

class SeriesController extends Controller
{
    public function index()
    {
        $series = auth()->user()->series ?? [];

        return view('scholar.series.index', compact('series'));
    }

    public function show(Series $series)
    {
        $works = $series->works;

        $optionWorks = $series->getOptionWorks($works->pluck('work_id'));

        return view('scholar.series.show', compact('series', 'optionWorks', 'works'));
    }

    public function create()
    {
        $accounts = auth()->user()->accounts()->whereNotNull('approved_at')->get();
        return view('scholar.series.create', compact('accounts'));
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

        $series = Series::create($data);
        return redirect(route('scholar.series.show', ['series' => $series]))->withSuccess('Series created!');
    }
}
