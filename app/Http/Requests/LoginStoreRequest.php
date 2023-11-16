<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginStoreRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'email' => ['required', 'string', 'email', 'max:191','exists:users,email'],
            'password' => ['required', 'max:255'],
        ];
    }

    public function attributes()
    {
        return [
            'email' => 'Email',
            'password' => 'Password'
        ];
    }
    public function messages()
    {
        return [
            'required' => ':attribute is required',
            'email' => 'Your email is not registered yet!',
            'max' => ':attribute should not be more than ' . ':max' . ' words',
        ];
    }
}
