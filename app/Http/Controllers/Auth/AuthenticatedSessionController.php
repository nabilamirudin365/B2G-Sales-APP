<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Validation\ValidationException;

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
    public function store(Request $request)
{
    // Validasi input
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    // Coba autentikasi
    if (Auth::attempt($credentials, $request->boolean('remember'))) {
        $request->session()->regenerate();

        $user = Auth::user();

        // Redirect berdasarkan role dari kolom 'role'
        switch ($user->role) {
        case 'admin':
            return redirect('/admin/dashboard');

        // Gabungkan case untuk kedua role sales
        case 'tim_b2g':
        case 'tim_merchant': // <-- INI PERBAIKANNYA
            return redirect('/sales/dashboard');

        default:
            return redirect('/'); // fallback
    }
    }

    // Jika gagal login
    throw ValidationException::withMessages([
        'email' => __('auth.failed'),
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

    protected function authenticated($request, $user)
{
    if ($user->hasRole('admin')) {
        return redirect()->route('admin.dashboard');
    }
    // else-if b2g / merchant…
    return redirect()->route('dashboard');
}

}
