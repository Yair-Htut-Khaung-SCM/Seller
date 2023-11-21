<?php

namespace App\Dao\Admin;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Str;
use DateTime;

class UserDao
{

    public function getDetail()
    {
        $result = User::paginate(10);
        return $result;
    }

    public function getCount()
    {
        return User::count();
    }

    public function deleteUser($id)
    {
        $user = User::find($id);
        $user->delete();
        return $user;
    }

}