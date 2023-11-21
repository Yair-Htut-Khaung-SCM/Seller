<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Admin\UserService;

class UserController extends Controller
{
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        $users = $this->userService->getDetail();
        return view('admin.users.index', compact('users'));
    }

    public function update($id)
    {
        return redirect()->route('admin.users.index')->with('error', 'This action is unavailable.');
    }

    public function destroy($id)
    {
        $users = $this->userService->deleteUser($id);
        return redirect()->route('admin.users.index')->with('success', 'User is successfully deleted.');
    }
}
