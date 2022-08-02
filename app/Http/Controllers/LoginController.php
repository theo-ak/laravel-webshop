<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function create()
    {
        return view('login');
    }

    public function store()
    {

        $credentials = request()->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if (auth()->attempt($credentials)) {
            session()->regenerate();

            return redirect('/');
        }

//        dd($credentials);

        return back()
            ->withInput()
            ->withErrors(['email' => 'Invalid credentials.']);

    }

    public function destroy()
    {
        auth()->logout();

        return redirect('/')->with('success', 'Goodbye!');
    }
}
