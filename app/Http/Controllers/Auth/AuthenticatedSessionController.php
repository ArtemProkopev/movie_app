<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Login', [
            'canResetPassword' => Route::has('password.request'),
            'status' => session('status'),
        ]);
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        try {
            // Логируем попытку входа
            Log::info('Login attempt', ['email' => $request->email, 'ip' => $request->ip()]);

            $request->authenticate();

            $request->session()->regenerate();

            Log::info('User authenticated', ['user_id' => Auth::id()]);

            return redirect()->intended(route('dashboard', absolute: false))
                ->with('status', 'Вы успешно вошли в систему');

        } catch (\Exception $e) {
            Log::error('Authentication failed', [
                'email' => $request->email,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return back()
                ->withInput($request->only('email'))
                ->withErrors([
                    'email' => 'Произошла ошибка при входе. Пожалуйста, попробуйте позже.',
                ]);
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        try {
            $user = Auth::user();
            
            Auth::guard('web')->logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();

            Log::info('User logged out', ['user_id' => $user?->id]);

            return redirect('/')
                ->with('status', 'Вы успешно вышли из системы');

        } catch (\Exception $e) {
            Log::error('Logout failed', [
                'user_id' => Auth::id(),
                'error' => $e->getMessage()
            ]);

            return back()
                ->with('error', 'Произошла ошибка при выходе из системы');
        }
    }
}