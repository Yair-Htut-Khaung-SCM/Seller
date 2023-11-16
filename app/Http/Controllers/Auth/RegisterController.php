<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterStoreRequest;
use App\Models\ProfileImage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class RegisterController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(RegisterStoreRequest $request)
    {
        $user = User::where('email', $request->email)->first();
        if ($user != NULL) {
            throw ValidationException::withMessages([
                'email' => 'This email is already registered!',
            ]);
        }

        $user = new User();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->remember_token = $request->remember;
        $user->save();

        event(new Registered($user));

        Auth::login($user);
        
        $profile = new Profile();
        $profile->user_id = $user->id;
        $profile->status = 'Normal User';
        $profile->save();

        $profile_image = new ProfileImage();
        $profile_image->profile_id = $profile->id;
        $profile_image->name = 'default_avatar.jpeg';
        $profile_image->path = 'upload/test';
        $profile_image->url = 'upload/test/default_avatar.jpeg';
        $profile_image->save();

        return redirect('/email/verify')->with('message', 'Verification Link has sent. Check your E-mail.');
    }
}
