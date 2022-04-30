<?php

namespace App\Http\Controllers\Scholar;

use App\Models\Package;
use Illuminate\Http\Request;
use App\Rules\DateShouldAtLease;
use App\Http\Controllers\Controller;
use App\Models\SlidingBanner;

class SlidingBannerController extends Controller
{
    public function customValidate($request)
    {
         return $request->validate([
                'package_id' => 'required',
                'scheduled_at' => ['required', new DateShouldAtLease(14, "Event should at least be 14 days away.")],
                'file' => ['required', 'image', 'max:2000'],
            ]);
    }

    public function getData()
    {
        return [
            Package::whereType(Package::TYPE_SLIDING_BANNER)->get(),
        ];
    }

    public function index()
    {
        $slidingBanners = auth()->user()->slidingBanners;
        return view('scholar.sliding-banner.index', compact('slidingBanners'));
    }

    public function create()
    {
        [ $packages ] = $this->getData();
        return view('scholar.sliding-banner.create', compact('packages'));
    }

    public function show(Request $request, SlidingBanner $slidingBanner)
    {
        [ $packages ] = $this->getData();
        return view(
            'scholar.sliding-banner.show',
            compact('slidingBanner', 'packages')
        );
    }

    public function store(Request $request)
    {
        $data = $this->customValidate($request);

        $slidingBanner = SlidingBanner::processToCreate($data, $request);
        return redirect(route('scholars.sliding-banner.show', ['slidingBanner' => $slidingBanner]))->withSuccess('Created!');
    }

    public function update(Request $request, SlidingBanner $bulletin)
    {
      // to be
    }
}
