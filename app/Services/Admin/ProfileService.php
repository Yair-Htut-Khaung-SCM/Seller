<?php

namespace App\Services\Admin;

use App\Models\Profile;
use App\Models\AdminUser;

class ProfileService
{
    public function getDetail($id)
    {
        $result = AdminUser::where('id', $id)->first();
        return $result;
    }

    public function saveProfile($request, $id)
    {
        $profile = Profile::where('user_id', $id)->firstOrFail();
        $data = $request->except('_token','name','email','image');
        $profile->update($data);
        return $profile;
    }

    public function getProfileByUserId($id)
    {
        $profile = Profile::where('user_id', $id)->firstOrFail();
        return $profile;
    }

}
