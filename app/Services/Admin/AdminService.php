<?php

namespace App\Services\Admin;

use Illuminate\Support\Facades\File;
use App\Dao\Admin\AdminDao;

class AdminService
{
    public function __construct(AdminDao $adminDao)
    {
        $this->adminDao = $adminDao;
    }

    public function getDetail()
    {
        $result = $this->adminDao->getDetail();
        return $result;
    }

    public function getAdminByEmail($email)
    {
        $result = $this->adminDao->getAdminByEmail($email);
        return $result;
    }

    public function saveAdminUser($request)
    {
        $adminuser = $this->adminDao->saveAdminUser($request);
        return $adminuser;
    }


}
