<?php

namespace App\Services;

use App\Dao\ProfileImageDao;

class ProfileImageService
{
    public function __construct(ProfileImageDao $profileImageDao)
    {
        $this->profileImageDao = $profileImageDao;
    }

    public function getAll()
    {
        $result = $this->profileImageDao->getAll();
        return $result;
    }

    public function getProfileImageByUserId($id)
    {
        $result = $this->profileImageDao->getProfileImageByUserId($id);
        return $result;
    }

    public function getProfileImageByKey($key, $profile_id)
    {
        $result = $this->profileImageDao->getProfileImageByKey($key, $profile_id);
        return $result;
    }
}