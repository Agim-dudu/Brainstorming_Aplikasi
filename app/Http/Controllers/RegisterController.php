<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\RegisterRequest;

class RegisterController extends Controller
{
    public function show()
    {
        return view('register');
    }

    public function store(RegisterRequest $request): RedirectResponse
    {
        $query = User::create([
            'name' => $request->UsernameInput,
            'email' => $request->emailInput,
            'password' => Hash::make($request->passwordInput)
        ]);

        if ($query) {
            return redirect()->route('login');
        } else {
            return redirect()->back();
        }
    }
}
