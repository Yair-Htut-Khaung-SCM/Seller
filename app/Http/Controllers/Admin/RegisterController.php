<?php

namespace App\Http\Controllers\Admin;

use App\Models\AdminUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RegisterStoreRequest;
use Illuminate\Validation\ValidationException;

class RegisterController extends Controller
{
    public function create(){
        return view('admin.auth.register');
    }

    public function store(RegisterStoreRequest $request)
    {
        $user = AdminUser::where('email', $request->email)->first();
        if ($user != NULL) {
            throw ValidationException::withMessages([
                'email' => 'This email is already registered!',
            ]);
        }

        $user = new AdminUser();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        return redirect('/admin/login');
    }
}
