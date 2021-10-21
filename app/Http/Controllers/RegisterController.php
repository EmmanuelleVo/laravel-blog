<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RegisterController extends Controller
{
    public function create()
    {
        return view('register.create', [
            'page_title' => 'S’identifier'
        ]);
    }

    public function store(StoreUserRequest $request)
    {
         /*$validatedData = request()->validate([
            'username' => 'required|unique:users,username',
            'name' => ['required','min:3'],
            'email' => ['required','email', Rule::unique('users', 'email')], //unique:table,column
            'password' => 'required|min:3|max:32', // ou [] -> plus souple
        ]);*/

        User::create($request->validated());

        //session()->flash('success', __('flash-message.account-created'));

        return redirect('/')->with('success', __('flash-message.account-created'));

    }
}
