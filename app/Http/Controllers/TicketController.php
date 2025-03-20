<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Schedule;
use App\Models\HallSeat;
use App\Services\TicketService;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    protected $ticketService;

    public function __construct(TicketService $ticketService)
    {
        $this->ticketService = $ticketService;
    }

    public function create()
    {
        $schedules = Schedule::all();
        $hallSeats = HallSeat::all();

        return view('admin.tickets.create', compact('schedules', 'hallSeats'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'schedule_id' => 'required|exists:schedules,id',
            'hall_seat_id' => 'required|exists:hall_seats,id',
        ]);

        $this->ticketService->create([
            'schedule_id' => $request->input('schedule_id'),
            'hall_seat_id' => $request->input('hall_seat_id'),
        ]);

        return redirect()->route('admin.tickets.index')->with('success', 'Билет создан');
    }

    public function index()
    {
        $tickets = Ticket::all();

        return view('admin.tickets.index', compact('tickets'));
    }

    public function edit(Ticket $ticket)
    {
        $schedules = Schedule::all();
        $hallSeats = HallSeat::all();

        return view('admin.tickets.edit', compact('ticket', 'schedules', 'hallSeats'));
    }

    public function update(Request $request, Ticket $ticket)
    {
        $request->validate([
            'schedule_id' => 'required|exists:schedules,id',
            'hall_seat_id' => 'required|exists:hall_seats,id',
        ]);

        $ticket->update([
            'schedule_id' => $request->input('schedule_id'),
            'hall_seat_id' => $request->input('hall_seat_id'),
        ]);

        return redirect()->route('admin.tickets.index')->with('success', 'Билет обновлен');
    }

    public function destroy(Ticket $ticket)
    {
        $ticket->delete();


        return redirect()->route('admin.tickets.index')->with('success', 'Билет удален');
    }
}
