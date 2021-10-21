<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    public function destroy()
    {
        $username = auth()->user()->username;

        auth()->logout();

        return redirect('/')->with('success', 'Goodbye ' . $username);
    }

    public function create()
    {
        return view('sessions.create', ['page_title' => 'Log In']);
    }

    public function store()
    {
        $credentials = request()->validate([
            'email' => ['required', 'email'],
            'password' => 'required',
        ]);

        if (!auth()->attempt($credentials)) {
            throw ValidationException::withMessages(['email' => 'Your credentials do not match our records.']);
            /*return back()
                ->withInput()
                ->withErrors(['email' => 'Your credentials do not match our records.']);*/
        }

        // user is logged in
        // session fixation
        session()->regenerate();
        $username = auth()->user()->username;
        return redirect('/')->with('success', __('flash-message.login'));


    }
}
