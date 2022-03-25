<?php

namespace App\Http\Controllers\Scholar;

use App\Helpers\FileHelper;
use App\Http\Controllers\Controller;
use App\Models\Bulletin;
use App\Models\Package;
use App\Rules\DateShouldAtLease;
use Illuminate\Http\Request;

class BulletinController extends Controller
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
            Package::whereType(Package::TYPE_BULLETIN)->get(),
        ];
    }

    public function index()
    {
        $bulletins = auth()->user()->bulletins;
        return view('scholar.bulletin.index', compact('bulletins'));
    }

    public function create()
    {
        [ $packages ] = $this->getData();
        return view('scholar.bulletin.create', compact('packages'));
    }

    public function show(Request $request, Bulletin $bulletin)
    {
        [ $packages ] = $this->getData();
        return view('scholar.bulletin.show', compact('bulletin', 'packages'));
    }

    public function store(Request $request)
    {
        $data = $this->customValidate($request);

        $bulletin = Bulletin::processToCreate($data, $request);
        return redirect(route('scholar.bulletin.show', ['bulletin' => $bulletin]));
    }

    public function update(Request $request, Bulletin $bulletin)
    {
      // to be
    }
}
