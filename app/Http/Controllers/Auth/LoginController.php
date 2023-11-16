<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginStoreRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function store(LoginStoreRequest $request)
    {
        $user = User::where('email',$request->email)->first();

        if(! $user)
        {
            throw ValidationException::withMessages([
                'email' => 'This email is not registered',
            ]);
        }
        
        $credential = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if(! Auth::attempt($credential)){
            throw ValidationException::withMessages([
                'password' => 'Wrong Password!',
            ]);
        }
        $user->remember_token = $request->remember;
        $user->save();

        return redirect('/');
    }

    public function destroy()
    {
        Auth::logout();

        return redirect('/');
    }
}
