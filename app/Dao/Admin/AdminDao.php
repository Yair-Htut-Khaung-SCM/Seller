<?php

namespace App\Dao\Admin;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use App\Models\AdminUser;
use Carbon\Carbon;
use Illuminate\Support\Str;
use DateTime;
use App\Models\Post;
use App\Models\User;
use App\Models\BuildType;
use App\Models\Manufacturer;
use App\Models\PlateDivision;

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