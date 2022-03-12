<?php

namespace App\Http\Controllers;

use App\Models\ChangeLog;
use Illuminate\Http\Request;

class ChangelogController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth.basic']);
    }

    public function index()
    {
        $changelogs = Changelog::latest()->simplePaginate(2);
        return view('changelog.index', compact('changelogs'));
    }
    public function create()
    {
        return view('changelog.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        $log = ChangeLog::create($data);

        return "Log #" . $log->id . " was created!";
    }
}
