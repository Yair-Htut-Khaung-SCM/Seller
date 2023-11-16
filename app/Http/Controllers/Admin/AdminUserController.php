<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminUser;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = AdminUser::paginate(10);

        return view('admin.admin_users.index', compact('users'));
    }
}
