<?php

namespace App\Dao\Admin;

use App\Models\AdminUser;

class AdminDao
{

    public function getDetail()
    {
        $result = AdminUser::paginate(10);
        return $result;
    } 

    public function getAdminByEmail($email)
    {
        $result = AdminUser::where('email', $email)->first();
        return $result;
    }

    public function saveAdminUser($request)
    {
        $user = new AdminUser();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        return $user;
    }

}