<?php

namespace App\Services\Admin;

use App\Dao\Admin\ProfileDao;

class ProfileService
{
    public function __construct(ProfileDao $profileDao)
    {
        $this->profileDao = $profileDao;
    }

    public function getDetail($id)
    {
        $result = $this->profileDao->getDetail($id);
        return $result;
    }

    public function saveProfile($request, $id)
    {
        $user = $this->profileDao->saveProfile($request, $id);
        return $user;
    }

}
