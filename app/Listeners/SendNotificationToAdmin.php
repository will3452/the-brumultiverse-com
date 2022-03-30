<?php

namespace App\Listeners;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Queue\InteractsWithQueue;
use App\Notifications\ApprovalNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;

class SendNotificationToAdmin
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
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $owner = $event->marketing->user->name;
        $type = Str::headline(basename(get_class($event->marketing)));
        $admins = User::role(Role::SUPERADMIN)->get();
        foreach ($admins as $user) {
            Notification::send(
                $user,
                new ApprovalNotification("Marketing: $type of $owner has been saved, and need admin approval.", "#")
            );
        }
    }
}
