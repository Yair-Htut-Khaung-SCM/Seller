<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ForgetPasswordRequest extends FormRequest
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
            'email' => ['required', 'string', 'email', 'max:191'],
        ];
    }

    public function attributes()
    {
        return [
            'email' => 'Email'
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute is required',
            'email' => 'Input Format must be Email',
            'max' => ':attribute should not be more than ' . ':max' . ' words',
        ];
    }
}