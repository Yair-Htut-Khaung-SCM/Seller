<?php

namespace App\Dao;

use App\Models\ProfileImage;

class ProfileImageDao
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
}