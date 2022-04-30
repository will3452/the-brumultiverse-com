<?php

namespace App\Http\Controllers\Scholar;

use App\Models\Account;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Podcast;

class PodcastController extends Controller
{
    public function customValidate(Request $request)
    {
        $request->validate([
            'type' => 'required',
            'title' => 'required',
            'account' => 'required',
            'tags' => 'required',
            'description' => 'required',
            'cost' => ['numeric', 'gte:0'],
            'cost_type' => 'required',
            'credit' => 'required',
            'launch_at' => 'required',
            'cover' => ['image','max:2000'],
            'episode_type' => 'required',
        ]);
    }


    public function getData()
    {
        return [
            Account::getApprovedAccountsFor(auth()->id()),
        ];
    }

    public function index()
    {
        $podcasts = auth()->user()->podcasts;
        $accounts = auth()->user()->accounts()->whereNotNull('approved_at')->whereHas('podcasts')->get();
        return view('scholar.podcast.index', compact('podcasts', 'accounts'));
    }

    public function create(Request $request)
    {
        [$accounts] = $this->getData();
        return view('scholar.podcast.create', compact('accounts'));
    }

    public function store(Request $r)
    {
        $this->customValidate($r);
        $podcast = Podcast::processToCreate($r);

        return redirect(route('scholar.podcast.show', ['podcast' => $podcast]))->withSuccess('success');
    }

    public function show(Request $r, Podcast $podcast)
    {
        [$accounts] = $this->getData();
        return view('scholar.podcast.show', compact('accounts', 'podcast'));
    }

    public function update(Request $r, Podcast $podcast)
    {
        Podcast::processToUpdate($r, $podcast);

        return back()->withSuccess('success!');
    }
}
