<?php

namespace App\Http\Controllers\Scholar;

use App\Models\Package;
use App\Models\LoadingImage;
use Illuminate\Http\Request;
use App\Rules\DateShouldAtLease;
use App\Http\Controllers\Controller;

class LoadingImageController extends Controller
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
            Package::whereType(Package::TYPE_LOADING_IMAGE)->get(),
        ];
    }

    public function index()
    {
        $loadingImages = auth()->user()->loadingImages;
        return view('scholar.loading-image.index', compact('loadingImages'));
    }

    public function create()
    {
        [ $packages ] = $this->getData();
        return view('scholar.loading-image.create', compact('packages'));
    }

    public function show(Request $request, LoadingImage $loadingImage)
    {
        [ $packages ] = $this->getData();
        return view(
            'scholar.loading-image.show',
            compact('loadingImage', 'packages')
        );
    }

    public function store(Request $request)
    {
        $data = $this->customValidate($request);

        $loadingImage = LoadingImage::processToCreate($data, $request);
        return redirect(route('scholars.loading-image.show', ['loadingImage' => $loadingImage]))->withSuccess('Created!');
    }

    public function update(Request $request, LoadingImage $loadingImage)
    {
      // to be
    }
}
