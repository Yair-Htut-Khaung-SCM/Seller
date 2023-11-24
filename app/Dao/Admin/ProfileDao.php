<?php

namespace App\Dao\Admin;

use App\Models\Profile;

class ProfileDao
{

    public function getDetail($id)
    {
        $result = AdminUser::where('id', $id)->first();
        return $result;
    }

    public function saveProfile($request, $id)
    {
        $user = AdminUser::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return $user;
    }

    public function getProfileByUserId($id)
    {
        $profile = Profile::where('user_id', $id)->firstOrFail();
        return $profile;
    }

}