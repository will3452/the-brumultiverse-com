<?php

namespace App\Http\Controllers\Scholar;

use App\Models\Group;
use App\Models\Account;
use App\Models\GroupType;
use App\Models\GroupMember;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\GroupInvitation;

class GroupController extends Controller
{

    public function customValidate(Request $request)
    {
        return $request->validate([
            'name' => ['required', 'unique:groups,name'],
            'account_id' => ['required', 'exists:accounts,id'],
            'type' => ['required'],
            'description' => ['required'],
        ]);
    }

    public function create()
    {
        $accounts = auth()->user()->accounts()->whereNotNull('approved_at')->get();
        $types = GroupType::get();
        return view('scholar.group.create', compact('accounts', 'types'));
    }

    public function index()
    {
        $accounts = auth()->user()->accounts()->whereNotNull('approved_at')->get();
        $memberships = GroupMember::confirmed()->whereIn('account_member_id', [$accounts->pluck('id')])->get();

        return view('scholar.group.index', compact('memberships'));
    }


    public function show(Group $group)
    {
        $group->load('members'); // lazy load

        return view('scholar.group.show', compact('group'));
    }

    public function store(Request $request)
    {
        $this->customValidate($request);

        $group = Group::processToCreate($request);


        if ($request->has('book')) {
            $group->books()->attach($request->book);
        }

        return redirect(route('scholar.group.show', ['group' => $group]));
    }

    public function getAccountId($str)
    {
        return Account::wherePenname($str)->first()->id;
    }

    public function addMember(Request $request, Group $group)
    {
        $data = $request->validate([
            'account' => ['required', 'exists:accounts,penname'],
            'position' => 'required',
        ]);

        $accountId = $this->getAccountId($data['account']);


        GroupMember::create([
            'group_id' => $group->id,
            'account_member_id' => $accountId,
            'position' => $data['position'],
        ]);

        return back()->withSuccess('Invitation sent!');
    }

    public function editPosition(Request $request, GroupMember $member)
    {
        $member->update(['position' => $request->position]);

        return back()->withSuccess('Position edited!');
    }

    public function editCommission(Request $request, GroupMember $member)
    {
        if ($request->rate > 100) {
            return back()->withError('Commission not valid!');
        }
        $member->update(['commission_rate' => $request->rate]);

        return back()->withSuccess('Commission edited!');
    }

    public function invitationGet()
    {
        $invitations = GroupInvitation::whereUserId(auth()->id())->get();
        return view('scholar.group.invitation', compact('invitations'));
    }

    public function acceptInvitation(GroupInvitation $invitation)
    {
        $invitation->markAsConfirmed();
        return back()->withSuccess('Confirmed!');
    }
}
