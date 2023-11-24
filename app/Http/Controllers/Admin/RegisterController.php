<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RegisterStoreRequest;
use Illuminate\Validation\ValidationException;
use App\Services\Admin\AdminService;

class RegisterController extends Controller
{
    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
    }

    public function create(){
        return view('admin.auth.register');
    }

    public function store(RegisterStoreRequest $request)
    {
        $user = $this->adminService->getAdminByEmail($request->email);
        if ($user != NULL) {
            throw ValidationException::withMessages([
                'email' => 'This email is already registered!',
            ]);
        }

        $user = $this->adminService->saveAdminUser($request);
        return redirect('/admin/login');
    }
}
