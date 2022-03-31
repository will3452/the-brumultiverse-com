<?php

namespace App\Models\Traits;

use App\Models\Ticket;

trait HasTickets
{

    public function tickets()
    {
        return $this->morphMany(Ticket::class, 'model');
    }

    public function ticketCanUpdate()
    {
        return self::TICKET_EDITABLE;
    }
}
