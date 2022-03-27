<?php

namespace App\Listeners;

use App\Models\Role;
use App\Models\User;
use App\Events\MarketingHasBeenSaved;
use App\Notifications\ApprovalNotification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

class SendNotificationToAdministrator
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\MarketingHasBeenSaved  $event
     * @return void
     */
    public function handle(MarketingHasBeenSaved $event)
    {
        $admins = User::role(Role::SUPERADMIN)->get();
        $marketing = $event->marketing;
        Log::info($marketing);
        $marketingOwner = $marketing->user->name;
        foreach ($admins as $a) {
            Notification::send($a, new ApprovalNotification("Marketing $marketing->type of $marketingOwner has been saved and need approval.", '#'));
        }
    }
}
