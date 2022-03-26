<?php

namespace App\Http\Controllers\Scholar;

use App\Models\Package;
use Illuminate\Http\Request;
use App\Rules\DateShouldAtLease;
use App\Http\Controllers\Controller;
use App\Models\Marquee;

class MarqueeController extends Controller
{
    public function customValidate($request)
    {
         return $request->validate([
                'package_id' => 'required',
                'scheduled_at' => ['required', new DateShouldAtLease(14, "Event should at least be 14 days away.")],
                'content' => ['required', 'max:101'],
            ]);
    }

    public function getData()
    {
        return [
            Package::whereType(Package::TYPE_MARQUEE)->get(),
        ];
    }

    public function index()
    {
        $marquees = auth()->user()->marquees;
        return view('scholar.marquee.index', compact('marquees'));
    }

    public function create()
    {
        [ $packages ] = $this->getData();
        return view('scholar.marquee.create', compact('packages'));
    }

    public function show(Request $request, Marquee $marquee)
    {
        [ $packages ] = $this->getData();
        return view('scholar.marquee.show', compact('marquee', 'packages'));
    }

    public function store(Request $request)
    {
        $data = $this->customValidate($request);

        $marquee = Marquee::processToCreate($data, $request);
        return redirect(route('scholar.bulletin.show', ['marquee' => $marquee]));
    }

    public function update(Request $request, Marquee $bulletin)
    {
      // to be
    }
}
