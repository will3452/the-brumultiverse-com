<?php

namespace App\Http\Controllers\Scholar;

use App\Models\Account;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PodcastController extends Controller
{
    public function customValidate(Request $request)
    {
        $request->validate([
            'type' => 'required',
            'title' => 'required',
            'account' => 'required',
            'genre' => 'required',
            'tags' => 'required',
            'description' => 'required',
            'cost' => ['numeric', 'gte:0'],
            'cost_type' => 'required',
            'credit' => 'required',
            'launch_at' => 'required',
            'cover' => ['image','max:2000'],
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
        return view('scholar.podcast.index', compact('podcasts'));
    }

    public function create(Request $request)
    {
        [$accounts] = $this->getData();
        return view('scholar.podcast.create', compact('accounts'));
    }

}
