<?php

namespace App\Http\Controllers;

use App\Enums\GeneralType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ProfileStoreRequest;
use App\Services\Admin\PostService;
use App\Services\Admin\ProfileService;
use App\Services\Admin\UserService;
use App\Services\ProfileImageService;

class ProfileController extends Controller
{
    public function __construct(ProfileService $profileService, UserService $userService, ProfileImageService $profileImageService,PostService $postService)
    {
        $this->postService = $postService;
        $this->profileService = $profileService;
        $this->userService = $userService;
        $this->profileImageService = $profileImageService;
    }

    public function showown_sale()
    {
        $id = Auth::user()->id;
        $user = $this->userService->getUserById($id);
        $user_profile = $this->profileService->getProfileByUserId($id);
        $user_img = $this->profileImageService->getProfileImageByKey('profile_id',$user_profile->id);
        $userbuy = $this->userService->getAll();
        $usersale = $this->userService->getAll();
        $users = $this->userService->getAll();
        $profile_image = $this->profileImageService->getAll();
        $posts = $this->postService->getPostByPurpose(GeneralType::PURPOSE_SALE, $id);

        return view('profile.showown_sale', compact('posts', 'user', 'user_profile', 'user_img', 'usersale', 'profile_image', 'users'));
    }
    public function showown_buy()
    {
        $id = Auth::user()->id;
        $user = $this->userService->getUserById($id);
        $user_profile = $this->profileService->getProfileByUserId($id);
        $user_img = $this->profileImageService->getProfileImageByKey('profile_id',$user_profile->id);
        $userbuy = $this->userService->getAll();
        $usersale = $this->userService->getAll();
        $users = $this->userService->getAll();
        $profile_image = $this->profileImageService->getAll();
        $posts = $this->postService->getPostByPurpose(GeneralType::PURPOSE_BUY, $id);

        return view('profile.showown_buy', compact('posts', 'user', 'user_profile', 'user_img', 'userbuy', 'profile_image', 'users'));
    }

    public function edit()
    {
        return view('profile.edit');
    }

    public function update(ProfileStoreRequest $request)
    {
        $id = Auth::user()->id;
        $user = $this->userService->saveUser($request, $id);
        $profile = $this->profileService->saveProfile($request, $id);

        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $dir = 'upload/images/profile/' . $profile->id;
            $path = $file->storeAs($dir, $filename);

            if ($profile->profile_image) {
                Storage::delete($profile->profile_image->path . '/' . $profile->profile_image->name);
                $image = $this->profileImageService->updateProfileImage($profile->id, $filename, url($dir . '/' . $filename));

            } else {
                $image = $this->profileImageService->saveProfileImage($profile->id, $filename, $dir, url($dir . '/' . $filename));
            }

            $file = $file->move(public_path('upload/images/profile/'. $profile->id ), $filename); 
        }

        return redirect('/profile/sale');
    }
    public function showsale_other($id)
    {
        $userbuy = $this->userService->getAll();
        $usersale = $this->userService->getAll();
        $users = $this->userService->getAll();
        $profile_image = $this->profileImageService->getAll();
        $posts = $this->postService->getOtherPostByPurpose(GeneralType::PURPOSE_SALE, $id);
        $user = $this->userService->getUserById($id);
        $user_profile = $this->profileService->getProfileByUserId($id);
        $user_img = $this->profileImageService->getProfileImageByKey('profile_id',$user_profile->id);

        return view('profile.showsale', compact('posts', 'user', 'user_profile', 'user_img', 'usersale', 'userbuy', 'profile_image', 'users'));        
    }

    public function showbuy_other($id)
    {
        $userbuy = $this->userService->getAll();
        $usersale = $this->userService->getAll();
        $users = $this->userService->getAll();
        $profile_image = $this->profileImageService->getAll();
        $posts = $this->postService->getOtherPostByPurpose(GeneralType::PURPOSE_BUY, $id);
        $user = $this->userService->getUserById($id);
        $user_profile = $this->profileService->getProfileByUserId($id);
        $user_img = $this->profileImageService->getProfileImageByKey('profile_id',$user_profile->id);
        
        return view('profile.showbuy', compact('posts', 'user', 'user_profile', 'user_img', 'usersale', 'userbuy', 'profile_image', 'users'));
    }
}
