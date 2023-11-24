<?php

namespace App\Services\Admin;

use App\Dao\Admin\UserDao;

class UserService
{
    public function __construct(UserDao $userDao)
    {
        $this->userDao = $userDao;
    }

    public function getDetail()
    {
        $result = $this->userDao->getDetail();
        return $result;
    }

    public function getCount()
    {
        return $this->userDao->getCount();
    }

    public function deleteUser($id)
    {
        $build_type = $this->userDao->deleteUser($id);
        return $build_type;
    }

    public function getAll()
    {
        $result = $this->userDao->getAll();
        return $result;
    }

    public function getUserById($id)
    {
        $result = $this->userDao->getUserById($id);
        return $result;
    }
}
