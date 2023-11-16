<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\Profile;
use App\Models\ProfileImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProfileResource;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\API\ProfileStoreRequest;

class MyProfileController extends Controller
{
    public function show()
    {
        $user = User::find(auth()->id());

        return response()->json(ProfileResource::make($user));
    }

    public function update(ProfileStoreRequest $request)
    {
        $id = auth()->id();
        $user = User::find($id);

        $profile = Profile::where('user_id', $id)->first();

        $user->update([
            'name' => $request->name,
            // 'email' => $request->email,
        ]);

        $profile->update([
            'status' => $request->status,
            'phone' => $request->phone,
            'address' => $request->address,
            'description' => $request->description
        ]);

        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $filename = date('YmdHis') . $file->getClientOriginalName();
            $dir = 'upload/images/profile/' . $profile->id;
            $path = $file->storeAs($dir, $filename);

            if ($profile->profile_image) {
                Storage::delete($profile->profile_image->path . '/' . $profile->profile_image->name);

                $image = ProfileImage::where('profile_id', $profile->id)->first();
                $image->name = $filename;
                $image->url = url($dir . '/' . $filename);

                $image->save();
            } else {
                $image = new ProfileImage();

                $image->profile_id = $profile->id;
                $image->name = $filename;
                $image->path = $dir;
                $image->url = url($dir . '/' . $filename);

                $image->save();
            }
        }

        return response()->json(['message' => 'Profile Update Successful']);
    }
}
