<?php

namespace App\Events;

use Illuminate\Support\Str;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class MarketingSaved
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $marketing;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($marketing)
    {
        $this->marketing = $marketing;
    }

    public function getMessage()
    {
        $owner = $this->marketing->user->name;
        $type = Str::headline(basename(get_class($this->marketing)));
        return "Marketing: $type of $owner has been saved, and need admin approval.";
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
