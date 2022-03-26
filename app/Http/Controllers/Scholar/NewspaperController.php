<?php

namespace App\Http\Controllers\Scholar;

use App\Models\Package;
use Illuminate\Http\Request;
use App\Rules\DateShouldAtLease;
use App\Http\Controllers\Controller;
use App\Models\Newspaper;

class NewspaperController extends Controller
{
    public function customValidate($request)
    {
         return $request->validate([
                'package_id' => 'required',
                'scheduled_at' => ['required', new DateShouldAtLease(14, "Event should at least be 14 days away.")],
                'headline' => 'required',
                'content' => 'required'
            ]);
    }

    public function getData()
    {
        return [
            Package::whereType(Package::TYPE_NEWSPAPER)->get(),
        ];
    }

    public function index()
    {
        $newspapers = auth()->user()->newspapers;
        return view('scholar.newspaper.index', compact('newspapers'));
    }

    public function create()
    {
        [ $packages ] = $this->getData();
        return view('scholar.newspaper.create', compact('packages'));
    }

    public function show(Request $request, Newspaper $newspaper)
    {
        [ $packages ] = $this->getData();
        return view('scholar.newspaper.show', compact('newspaper', 'packages'));
    }

    public function store(Request $request)
    {
        $data = $this->customValidate($request);

        $newspaper = Newspaper::processToCreate($data, $request);
        return redirect(route('scholar.newspaper.show', ['newspaper' => $newspaper]));
    }

    public function update(Request $request, Newspaper $newspaper)
    {
      // to be
    }

}
