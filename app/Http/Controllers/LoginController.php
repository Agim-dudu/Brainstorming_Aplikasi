<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;


class LoginController extends Controller
{
    public function show()
    {
        return view('login');
    }
    public function auth(LoginRequest $request): RedirectResponse
    {
        $credentials = $request->validated();

        if (Auth::attempt($credentials, $request->checkRemember)) {
            $request->session()->regenerate();
            return redirect()->route('product');
        }

        return back()->withErrors([
            'email' => 'Tidak ada akun yang cocok dengan inputan anda'
        ])->onlyInput('email');
    }


    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
