<?php

namespace App\Http\Controllers\Scholar;

use App\Models\Account;
use Illuminate\Http\Request;
use App\Rules\DateShouldAtLease;
use App\Http\Controllers\Controller;
use App\Models\Event;

class EventsController extends Controller
{
    public function customValidate(Request $request)
    {
        $request->validate([
            // 'type' => 'required',
            'title' => 'required',
            'description' => 'required',
            'account' => 'required',
            // 'cost' => ['numeric', 'gte:0'],
            // 'cost_type' => 'required',
            // 'status' => '',
            'start_date' => ['required', new DateShouldAtLease(nova_get_setting('event_day_away', 60), "Event should at least be " . nova_get_setting('event_day_away', 60) . " days away.")],
            'end_date' => ['required', 'after:start_date'],
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
        $events = auth()->user()->events;
        return view('scholar.event.index', compact('events'));
    }

    public function create()
    {
        [$accounts] = $this->getData();

        return view('scholar.event.create', compact('accounts'));
    }

    public function store(Request $request)
    {
        $this->customValidate($request);
        $event = Event::processToCreate($request);

        return redirect(route('scholar.event.show', ['event' => $event]));
    }

    public function show(Request $request, Event $event)
    {
        [$accounts] = $this->getData();
        return view('scholar.event.show', compact('event', 'accounts'));
    }

    public function update(Request $request, Event $event)
    {
        $this->customValidate($request);
        Event::processToUpdate($request, $event);
        return back()->withSuccess('success!');
    }

    public function requestForApproval(Event $event)
    {
        $event->update([
            'status' => Event::STATUS_FOR_APPROVAL,
        ]);
        return back()->withSuccess('Request sent!');
    }
}
