<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Profile;
use App\Models\ProfileImage;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\ProfileStoreRequest;
use App\Models\Manufacturer;
use App\Models\PlateDivision;
use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\PostUpdateRequest;

class ProfileController extends Controller
{
    public function showown_sale()
    {

        $id = Auth::user()->id;
        $user = User::where('id', $id)->first();
        $user_profile = Profile::where('user_id', $id)->firstOrFail();
        $user_img = ProfileImage::where('profile_id', $user_profile->id)->first();
        $userbuy = User::all();
        $usersale = User::all();
        $users = User::all();
        $profile_image = ProfileImage::all();
        $posts =  Post::where('user_id','=',$id)
        ->where('purpose','=','sale')->paginate(6);


        return view('profile.showown_sale', compact('posts', 'user', 'user_profile', 'user_img', 'usersale', 'profile_image', 'users'));
    }
    public function showown_buy()
    {

        $id = Auth::user()->id;
        $user = User::where('id', $id)->first();
        $user_profile = Profile::where('user_id', $id)->firstOrFail();
        $user_img = ProfileImage::where('profile_id', $user_profile->id)->first();
        $userbuy = User::all();
        $usersale = User::all();
        $users = User::all();
        $profile_image = ProfileImage::all();
        $posts =  Post::where('user_id','=',$id)
        ->where('purpose','=','buy')->paginate(6);


        return view('profile.showown_buy', compact('posts', 'user', 'user_profile', 'user_img', 'userbuy', 'profile_image', 'users'));
    }

    public function edit()
    {
        return view('profile.edit');
    }

    public function update(ProfileStoreRequest $request)
    {
        $id = Auth::user()->id;
        $user = User::find($id);

        $profile = Profile::where('user_id', $id)->first();

        $user->name = $request->name;
        $user->email = $request->email;
        // $user->password = bcrypt($request->password);
        $user->save();

        $profile->status = $request->status;
        $profile->phone = $request->phone;
        $profile->address = $request->address;
        $profile->description = $request->description;
        $profile->save();

        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $dir = 'upload/images/profile/' . $profile->id;
            $path = $file->storeAs($dir, $filename);
            // $file->move(public_path('upload/images/'.$profile->id.'/profile'), $filename);

            if ($profile->profile_image) {
                // dd($profile->profile_image);
                // File::delete($profile->profile_image->path . '/' . $profile->profile_image->name);
                Storage::delete($profile->profile_image->path . '/' . $profile->profile_image->name);

                $image = ProfileImage::where('profile_id', $profile->id)->first();
                $image->name = $filename;
                $image->url = url($dir . '/' . $filename);
                $file = $file->move(public_path('upload/images/profile/'. $profile->id ), $filename); 

                $image->save();
            } else {
                $image = new ProfileImage();

                $image->profile_id = $profile->id;
                $image->name = $filename;
                $image->path = $dir;
                $image->url = url($dir . '/' . $filename);
                $file = $file->move(public_path('upload/images/profile/'. $profile->id ), $filename); 

                $image->save();
            }
        }

        return redirect('/profile/sale');
    }
    public function showsale_other($id)
    {
        $userbuy = User::all();
        $usersale = User::all();
        $users = User::all();
        $profile_image = ProfileImage::all();
        $posts =  Post::where('user_id','=',$id)->where('purpose','=','sale')->where('is_published','=','1')->paginate(6);
        $user = User::where('id', $id)->first();
        $user_profile = Profile::where('user_id', $id)->first();
        $user_img = ProfileImage::where('profile_id', $user_profile->id)->first();


        return view('profile.showsale', compact('posts', 'user', 'user_profile', 'user_img', 'usersale', 'userbuy', 'profile_image', 'users'));        
    }

    public function showbuy_other($id)
    {
        $userbuy = User::all();
        $usersale = User::all();
        $users = User::all();
        $profile_image = ProfileImage::all();
        $posts =  Post::where('user_id','=',$id)->where('purpose','=','buy')->where('is_published','=','1')->paginate(6);
        $user = User::where('id', $id)->first();
        $user_profile = Profile::where('user_id', $id)->first();
        $user_img = ProfileImage::where('profile_id', $user_profile->id)->first();
        
        
        return view('profile.showbuy', compact('posts', 'user', 'user_profile', 'user_img', 'usersale', 'userbuy', 'profile_image', 'users'));
    }
}
