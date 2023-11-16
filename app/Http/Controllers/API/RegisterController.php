<?php

namespace App\Http\Controllers\API;

use Throwable;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterStoreRequest;

class RegisterController extends Controller
{
    public function store(RegisterStoreRequest $request)
    {
        DB::beginTransaction();
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);

            $profile = new Profile();
            $profile->user_id = $user->id;
            $profile->status = 'Normal User';
            $profile->save();
            DB::commit();
            return response()->json(['message' => 'Registration Successful. Please Login.']);
        } catch (Throwable $th) {
            DB::rollBack();
            Log::error(__CLASS__ . '::' . __FUNCTION__ . '[line: ' . __LINE__ . '][Registration failed] Message: ' . $th->getMessage());
            return response()->json([
                'message' => 'Registration failed.',
            ], 500);
        }
    }
}
