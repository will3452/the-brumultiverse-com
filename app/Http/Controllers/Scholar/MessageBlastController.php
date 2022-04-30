<?php

namespace App\Http\Controllers\Scholar;

use App\Models\Package;
use Illuminate\Http\Request;
use App\Rules\DateShouldAtLease;
use App\Http\Controllers\Controller;
use App\Models\MessageBlast;

class MessageBlastController extends Controller
{
    public function customValidate($request)
    {
         return $request->validate([
                'package_id' => 'required',
                'scheduled_at' => ['required', new DateShouldAtLease(14, "Event should at least be 14 days away.")],
                'subjects' => 'required',
                'messages' => 'required',
            ]);
    }

    public function getData()
    {
        return [
            Package::whereType(Package::TYPE_MESSAGE_BLAST)->get(),
        ];
    }

    public function index()
    {
        $messageBlasts = auth()->user()->messageBlasts;
        return view('scholar.message-blast.index', compact('messageBlasts'));
    }

    public function create()
    {
        [ $packages ] = $this->getData();
        return view('scholar.message-blast.create', compact('packages'));
    }


    public function show(Request $request, MessageBlast $messageBlast)
    {
        [ $packages ] = $this->getData();
        return view('scholar.message-blast.show', compact('messageBlast', 'packages'));
    }

    public function store(Request $request)
    {
        $data = $this->customValidate($request);

        $messageBlast = MessageBlast::processToCreate($data, $request);
        return redirect(route('scholars.message-blast.show', ['messageBlast' => $messageBlast]))
            ->withSuccess('Created!');
    }

    public function update(Request $request, MessageBlast $messageBlast)
    {
      // to be
    }
}
