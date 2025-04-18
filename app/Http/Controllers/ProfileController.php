<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Schedule; 

class ProfileController extends Controller
{
    public function show(Request $request)
    {
        $user = $request->user();
        
        $tickets = $user->tickets()
            ->with([
                'schedule.hall:id,name',
                'schedule.movie:id,title',
                'hallSeat:id,row,seat_number'
            ])
            ->whereHas('schedule', function($query) {
                $query->whereHas('hall');
            })
            ->latest()
            ->paginate(10);
        
        // Добавляем запрос для получения доступных сеансов
        $availableTickets = Schedule::with(['movie:id,title', 'hall:id,name,capacity'])
            ->where('start_time', '>', now())
            ->whereHas('hall')
            ->latest()
            ->paginate(10);
        
        return Inertia::render('Profile/Show', [
            'user' => $user->only([
                'id', 'name', 'last_name', 'email', 
                'phone_number', 'birthday', 'created_at'
            ]),
            'tickets' => $tickets,
            'availableTickets' => $availableTickets, // Добавляем этот параметр
        ]);
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $user->fill($request->validated());

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return Redirect::route('profile.edit')
            ->with('status', 'Данные профиля успешно обновлены');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();
        Auth::logout();
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/')
            ->with('status', 'Аккаунт успешно удален');
    }
}