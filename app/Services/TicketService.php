<?php

namespace App\Services;

use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;

class TicketService
{
    public function create(array $data): Ticket
    {
        return Ticket::create([
            'schedule_id' => $data['schedule_id'],
            'user_id' => Auth::id(),
            'hall_seat_id' => $data['hall_seat_id'],
        ]);
    }

    public function update(Ticket $ticket, array $data): Ticket
    {
        $ticket->update($data);
        return $ticket;
    }

    public function delete(Ticket $ticket): void
    {
        $ticket->delete();
    }
}

