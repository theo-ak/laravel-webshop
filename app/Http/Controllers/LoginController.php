<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function create()
    {
        return view('login');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages()
            ]);
        } elseif (auth()->attempt($validator->validated())) {
            session()->regenerate();

            return response()->json([
               'status' => 200,
               'message' => 'Login successful'
            ]);
        } else {
            return response()->json([
               'status' => 401,
               'message' => 'Invalid credentials'
            ]);
        }
    }

    public function destroy()
    {
        auth()->logout();

        return redirect('/')->with('success', 'Goodbye!');
    }
}
