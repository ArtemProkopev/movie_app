<?php

namespace App\Services;

use App\Models\Ticket;
use App\Models\Schedule;
use App\Models\HallSeat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;

class TicketService
{
    public function create(array $data): Ticket
    {
        $this->validateRelations($data);
        
        $seat = HallSeat::findOrFail($data['hall_seat_id']);
        $schedule = Schedule::findOrFail($data['schedule_id']);

        // Проверяем принадлежность места к залу сеанса
        if ($seat->hall_id !== $schedule->hall_id) {
            throw new \InvalidArgumentException('Место не принадлежит залу этого сеанса');
        }

        return Ticket::create([
            'schedule_id' => $schedule->id,
            'user_id' => Auth::id(),
            'hall_seat_id' => $seat->id,
            'price' => $seat->price,
        ]);
    }

    public function update(Ticket $ticket, array $data): Ticket
    {
        $this->validateRelations($data);
        
        $seat = HallSeat::findOrFail($data['hall_seat_id']);
        $schedule = Schedule::findOrFail($data['schedule_id']);

        if ($seat->hall_id !== $schedule->hall_id) {
            throw new \InvalidArgumentException('Место не принадлежит залу этого сеанса');
        }

        $ticket->update([
            'schedule_id' => $schedule->id,
            'hall_seat_id' => $seat->id,
            'price' => $seat->price,
        ]);
        
        return $ticket->fresh();
    }

    public function delete(Ticket $ticket): bool
    {
        try {
            return $ticket->delete();
        } catch (\Exception $e) {
            Log::error('Ошибка при удалении билета: '.$e->getMessage());
            return false;
        }
    }

    protected function validateRelations(array $data): void
    {
        Schedule::findOrFail($data['schedule_id']);
        HallSeat::findOrFail($data['hall_seat_id']);
    }
}