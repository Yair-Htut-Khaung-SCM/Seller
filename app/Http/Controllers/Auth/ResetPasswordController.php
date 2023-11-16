<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\ResetPasswordRequest;
use Illuminate\Validation\ValidationException;

class ResetPasswordController extends Controller
{
    public function create()
    {
        return view('auth.reset_password');
    }

    public function store(ResetPasswordRequest $request)
    {
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            throw ValidationException::withMessages([
                'message' => 'Something is wrong. Please try again!',
            ]);
        }

        $password = $request->password;
        // Validate the token
        $tokenData = DB::table('password_resets')
            ->where('token', $request->token)->first();

        // Redirect the user back to the password reset request form if the token is invalid
        if (!$tokenData){
            return redirect( route('forget-password.create') );
        }

        $user = User::where('email', $tokenData->email)->first();
        // Redirect the user back if the email is invalid
        if (!$user) return redirect()->back()->with('errors', 'Email not Found.');

        //Hash and update the new password
        $user->password =  bcrypt($password);
        $user->update();

        //Delete the token
        DB::table('password_resets')->where('email', $user->email)
            ->delete();

        return redirect( route('login.create') )->with('message', 'Reset password successfully. Please login again!');
    }
}
