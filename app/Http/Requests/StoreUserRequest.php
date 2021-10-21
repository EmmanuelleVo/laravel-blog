<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username' => 'required|unique:users,username',
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users', 'email')], //unique:table,column
            'password' => 'required|min:3|max:255', // ou [] -> plus souple
        ];
    }
}
