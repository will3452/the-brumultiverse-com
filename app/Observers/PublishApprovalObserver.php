<?php

namespace App\Observers;

use App\Models\PublishApproval;
use App\Notifications\ApprovalNotification;
use Illuminate\Support\Facades\Notification;

class PublishApprovalObserver
{
    public function created(PublishApproval $p)
    {
        $title = $p->model->title;
        $type = $p->model->modelType(true);
        Notification::send(auth()->user(), new ApprovalNotification("Successfully submitted publish approval for \" $type : $title \".", '#'));
    }

    public function updated(PublishApproval $p)
    {
        $title = $p->model->title;
        $type = $p->model->modelType(true);
        $message = "The published date of your work \"$type: $title\" is approved and already in place.";

        if ($p->status === PublishApproval::STATUS_APPROVED) {
            Notification::send($p->user, new ApprovalNotification($message, '#'));
        }
    }
}
