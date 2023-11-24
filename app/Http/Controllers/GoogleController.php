<?php

namespace App\Http\Controllers;

use App\Enums\GeneralType;
use App\Models\Profile;
use App\Models\ProfileImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use PHPUnit\Runner\Exception;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver(GeneralType::SOCIALIZE_GOOGLE)->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver(GeneralType::SOCIALIZE_GOOGLE)->user();

            $finduser = User::where('google_id', $user->id)->first();

            $emailuser = User::where('email', $user->email)->first();
            if ($finduser) {
                Auth::login($finduser);

                return redirect()->intended('/');
            } elseif ($emailuser) {
                $newUser = User::updateOrCreate(['email' => $user->email], [
                    'name' => $user->name,
                    'email_verified_at' => now(),
                    'google_id' => $user->id,
                ]);
                $profile = new Profile();
                $profile->user_id = $newUser->id;
                $profile->status = GeneralType::PROFILE_STATUS[0];

                $profile->save();

                $profile_image = new ProfileImage();
                $profile_image->profile_id = $profile->id;
                $profile_image->name = 'default_avatar.jpeg';
                $profile_image->path = 'upload/test';
                $profile_image->url = 'upload/test/default_avatar.jpeg';
                $profile_image->save();

                Auth::login($newUser);

                return redirect()->intended('/');
            } else {
                $newUser = User::updateOrCreate(['email' => $user->email], [
                    'name' => $user->name,
                    'email_verified_at' => now(),
                    'google_id' => $user->id,
                    'password' => Hash::make('password')
                ]);
                $profile = new Profile();
                $profile->user_id = $newUser->id;
                $profile->status = GeneralType::PROFILE_STATUS[0];

                $profile->save();

                $profile_image = new ProfileImage();
                $profile_image->profile_id = $profile->id;
                $profile_image->name = 'default_avatar.jpeg';
                $profile_image->path = 'upload/test';
                $profile_image->url = 'upload/test/default_avatar.jpeg';
                $profile_image->save();
                
                Auth::login($newUser);

                return redirect()->intended('/');
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}