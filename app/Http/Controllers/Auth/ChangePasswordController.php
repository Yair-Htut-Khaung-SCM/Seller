<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ChangePasswordRequest;
use Illuminate\Validation\ValidationException;

class ChangePasswordController extends Controller
{
    public function index()
    {
        $id= Auth::user()->id;
        return view('auth.change_password',compact('id'));
    }

    public function store(ChangePasswordRequest $request)
    {   
        $id= Auth::user()->id;
        $user = User::where('id',$id)->first();

        $credential = [
            'email' => Auth::user()->email,
            'password' => $request->old_password,
        ];

        if(! Auth::attempt($credential)){
            throw ValidationException::withMessages([
                'old_password' => 'Incorrect password',
            ]);
        }  
        $user->password =  bcrypt($request->password);
        $user->save();

        return redirect(route('profile.sale')); 
    }
}
