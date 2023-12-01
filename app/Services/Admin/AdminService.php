<?php

namespace App\Services\Admin;

use App\Models\AdminUser;

class AdminService
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
        $users = $request->except('_token','password_confirmation');
        $users['password'] = bcrypt($users['password']);
        $user = AdminUser::create($users);
        return $user;
    }

    public function updateAdminUser($request, $id)
    {
        $user = AdminUser::find($id);
        $user->update($request->all());
        return $user;
    }
}
