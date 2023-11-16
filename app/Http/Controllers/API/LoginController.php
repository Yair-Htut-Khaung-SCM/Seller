<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginStoreRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function store(LoginStoreRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            throw ValidationException::withMessages([
                'email' => 'This email is not registered',
            ]);
        }

        $credential = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (!Auth::attempt($credential)) {
            throw ValidationException::withMessages([
                'password' => 'Password is incorrect',
            ]);
        }

        $token = $user->createToken($request->email)->plainTextToken;

        return [
            'token' => $token,
            'user' => $user->only('id', 'name', 'email'),
        ];
    }

    public function destroy(Request $request)
    {
        // Revoke the token that was used to authenticate the current request
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logged Out'], 200);
    }
}
