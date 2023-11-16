<?php

namespace App\Http\Controllers\Admin;

use App\Models\AdminUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Admin\LoginStoreRequest;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function create()
    {
        return view('admin.auth.login');
    }
    public function store(LoginStoreRequest $request)
    {
        $user = AdminUser::where('email', $request->email)->first();
        // if($email == $user->email && $password == $user->password)
        // {
        //     $user->remember_token = $request->remember;
        //     $user->save();

        //     return redirect('/admin');
        // }
        // else{
        //     throw ValidationException::withMessages([
        //                 'password' => 'User Name or Password is wrong',
        //             ]);
        // }
        $credential = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        $email = $request->email;
        $password = $request->password;


        if (!Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password,])) {
            throw ValidationException::withMessages([
                'password' => 'User Name or Password is wrong',
            ]);
        }
        $user->remember_token = $request->remember;
        $user->save();

        return redirect('/admin');
    }
    public function destroy()
    {
        Auth::guard('admin')->logout();

        return redirect(route('admin.login.create'));
    }
}
