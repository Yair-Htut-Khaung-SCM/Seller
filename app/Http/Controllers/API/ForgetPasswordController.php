<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\Models\User;
use App\Mail\LinkMail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\ForgetPasswordRequest;
use Illuminate\Validation\ValidationException;

class ForgetPasswordController extends Controller
{
    public function store(ForgetPasswordRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            throw ValidationException::withMessages([
                'email' => 'This email is not registered',
            ]);
        }
        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => Str::random(60),
            'created_at' => Carbon::now()
        ]);

        $tokenData = DB::table('password_resets')
            ->where('email', $request->email)->first();

        if ($this->sendResetEmail($request->email, $tokenData->token)) {
            return response()->json(['message' => 'Password Reset Link has sent. Check your E-mail.']);
        } else {
            return response()->json(['message' => 'A Network Error occurred. Please try again.'], 500);
        }
    }
   
    private function sendResetEmail($email, $token)
    {
        //Retrieve the user from the database
        $user = DB::table('users')->where('email', $email)->select('name', 'email')->first();
        //Generate, the password reset link. The token generated is embedded in the link
        $link = url('')  . '/reset-password/' . $token . '?email=' . urlencode($user->email);
        $email = $user->email;
        
        try {
            Mail::to($email)->send(new LinkMail($link,$email));
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}
