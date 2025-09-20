<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserLoginController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('auth.user-login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'phone' => ['required', 'digits:10'],
            'login_code' => ['required', 'digits:4'],
        ]);

        $user = User::where('phone', $request->phone)
                    ->whereHas('card', fn($q) => $q->where('login_code', $request->login_code))
                    ->first();

        if ($user) {
            Auth::login($user);
            return redirect()->route('public.wallets.index');
        }

        return back()->withErrors([
            'phone' => 'Número de teléfono o PIN incorrecto.',
        ])->withInput();
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('user.login');
    }
}
