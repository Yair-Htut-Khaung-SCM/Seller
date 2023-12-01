<?php

namespace App\Services;

use App\Models\ProfileImage;

class ProfileImageService
{
    public function getAll()
    {
        $profileImage = ProfileImage::all();
        return $profileImage;
    }

    public function getProfileImageByUserId($id)
    {
       $profileImage = ProfileImage::where('profile_id', $id)->first();
       return $profileImage;
    }

    public function getProfileImageByKey($key, $id)
    {
        $profileImage = ProfileImage::where($key, $id)->first();
        return $profileImage;
    }

    public function saveProfileImage($profile_id, $filename, $dir,$url)
    {
        $image['profile_id']  = $profile_id;
        $image['name'] = $filename;
        $image['path'] = $dir;
        $image['url'] = $url;
        $result = ProfileImage::create($image);

        return $result;
    }

    public function updateProfileImage($profile_id, $filename, $url)
    {
        $image = ProfileImage::where('profile_id', $profile_id)->first();
        $image->name = $filename;
        $image->url = $url;
        $image->save();

        return $image;
    }
}