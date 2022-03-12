<?php

namespace App\Observers;

use App\Models\Group;
use App\Models\Account;

use App\Models\GroupMember;
use App\Models\Invitation;
use Doctrine\DBAL\Types\Type;

use function PHPUnit\Framework\isEmpty;

class GroupMemberObserver
{
    public function getAccountOnGroup($groupId)
    {
        $group = Group::find($groupId);

        $accountIds = auth()->user()->accounts()->pluck('id')->toArray();

        //the reason why account ids use loop because account might not be numerous.
        foreach ($accountIds as $aId) {
            $isExists = $group->members->where('account_member_id', $aId)->count();

            if ($isExists) {
                return Account::find($aId); // return the account id
            }
        }

        return Account::find($group->account_id);
    }
    public function creating(GroupMember $member)
    {
        $account = $this->getAccountOnGroup($member->group_id);

        if (! $account) {
            $member->group_id = null; // this will prevent the wrong moves of the user,
            return false;
        }

        $member->account_requestor_id = $account->id;
        if (! isset($member->remarks)) {
            $member->remarks = "Added by $account->penname";
        }
    }

    public function created(GroupMember $member)
    {
        $group = $member->group;
        $userId = Account::where('id', $member->account_member_id)->first()->user_id;
        if ($group->members()->count() > 1) {
            $account = $this->getAccountOnGroup($member->group_id);
            $groupName = $member->group->name;
            $member->invitation()->create([
                'type' => Invitation::TYPE_GROUP,
                'title' => "Invitation to join the $groupName group.",
                'body' => "You are invited by $account->penname to be one of the $groupName group members. ",
                'user_id' =>$userId,
            ]);
        }
    }
}
