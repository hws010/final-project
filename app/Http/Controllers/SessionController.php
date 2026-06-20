<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'email' => ['email', 'required'],
            'password' => ['required', 'min:8', 'max:25'],
        ]);

        if (Auth::attempt($validate)) {
            $request->session()->regenerate();

            return redirect('/')->with('success', 'you are loged in');
        }

        return redirect()->back()->withErrors(['password' => 'your creds are wrong!']);
    }

    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerate();

        return redirect('/')->with(['success' => 'you are logged out']);
    }
}
