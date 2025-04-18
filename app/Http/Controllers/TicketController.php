<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Schedule;
use App\Models\HallSeat;
use App\Services\TicketService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    protected $ticketService;

    public function __construct(TicketService $ticketService)
    {
        $this->ticketService = $ticketService;
    }

    public function create()
    {
        $schedules = Schedule::with(['movie', 'hall'])->get();
        return view('admin.tickets.create', compact('schedules'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'schedule_id' => [
                'required',
                'exists:schedules,id',
                function ($attr, $value, $fail) {
                    $schedule = Schedule::find($value);
                    if (!$schedule || !$schedule->hall_id) {
                        $fail('Выбранное расписание не имеет привязки к залу');
                    }
                }
            ],
            'hall_seat_id' => [
                'required',
                'exists:hall_seats,id',
                function ($attr, $value, $fail) use ($request) {
                    $schedule = Schedule::findOrFail($request->schedule_id);
                    $seat = HallSeat::findOrFail($value);
    
                    if ($seat->hall_id != $schedule->hall_id) {
                        $fail('Место не принадлежит залу этого сеанса');
                    }
                }
            ],
        ]);
    
        try {
            $seat = HallSeat::findOrFail($validated['hall_seat_id']);
            $validated['user_id'] = Auth::id();
            $validated['price'] = $seat->price;
    
            $ticket = Ticket::create($validated);
    
            return redirect()->route('admin.tickets.index')
                   ->with('success', 'Билет успешно создан');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Ошибка создания билета: ' . $e->getMessage()]);
        }
    }

    public function destroy(Ticket $ticket)
    {
        try {
            $this->ticketService->delete($ticket);
            
            return redirect()->route('admin.tickets.index')
                   ->with('success', 'Билет успешно удален');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Ошибка удаления билета: ' . $e->getMessage()]);
        }
    }

    public function index()
    {
        $tickets = Ticket::with([
                'schedule.movie',
                'schedule.hall',
                'hallSeat',
                'owner'
            ])->latest()->paginate(10);

        return view('admin.tickets.index', compact('tickets'));
    }
}