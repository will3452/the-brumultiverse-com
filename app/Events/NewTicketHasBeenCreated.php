<?php

namespace App\Events;

use App\Models\Chapter;
use App\Models\Ticket;
use Illuminate\Support\Str;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NewTicketHasBeenCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $ticket;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Ticket $ticket)
    {
        $this->ticket = $ticket;
    }

    public function getMessage()
    {
        $user = $this->ticket->user;
        if ($this->ticket->model_type === Chapter::class) {
            $owner = $this->ticket->model->model->user->name;
        } else {
            $owner = $user->name;
        }
        // $type = Str::headline(basename(get_class($this->)));
        return "$owner a scholar made a ticket for his/her work, and need admin approval.";
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
