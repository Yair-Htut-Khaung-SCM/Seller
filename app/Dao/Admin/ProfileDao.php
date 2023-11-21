<?php

namespace App\Dao\Admin;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use App\Models\AdminUser;

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

}