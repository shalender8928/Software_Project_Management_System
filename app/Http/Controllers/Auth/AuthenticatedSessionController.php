<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Redirect based on user role or default path
            if (Auth::user()->hasRole('Admin')) {
                return redirect()->intended('/admin/dashboard');
            } elseif (Auth::user()->hasRole('Senior Manager')) {
                return redirect()->intended('/senior-manager/dashboard');
            } elseif (Auth::user()->hasRole('Project Manager')) {
                return redirect()->intended('/project-manager/dashboard');
            } elseif (Auth::user()->hasRole('Developer')) {
                return redirect()->intended('/developer/dashboard');
            } elseif (Auth::user()->hasRole('Customer')) {
                return redirect()->intended('/customer/dashboard');
            } else {
                return redirect()->intended('/'); // Default redirect path Edit it as required ................................
            }
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
