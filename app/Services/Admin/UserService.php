<?php

namespace App\Services\Admin;

use App\Models\User;
use Illuminate\Support\Facades\DB;
class UserService
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

    public function deleteUser($user)
    {
        $user->delete();
        return $user;
    }

    public function getAll()
    {
        $user = User::all();
        return $user;
    }

    public function getUserById($id)
    {
        $user = User::where('id', $id)->first();
        return $user;
    }

    public function saveUser($request, $id)
    {
        $user = User::find($id);
        $user->update($request->all());
        return $user;
    }

    public function getUserName($id_array)
    {
        $user = User::whereIn('id', $id_array)
                ->orderByRaw(DB::raw("FIELD(id, " . implode(',', $id_array) . ")"))
                ->pluck('name');
        
        return $user->toArray();
    }

}
