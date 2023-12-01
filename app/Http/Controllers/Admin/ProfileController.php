<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Services\Admin\ProfileService;
use App\Services\Admin\AdminService;

class ProfileController extends Controller
{

    public function __construct(ProfileService $profileService,AdminService $adminService)
    {
        $this->profileService = $profileService;
        $this->adminService = $adminService;
    }

    public function index(){
        $id = Auth::guard('admin')->user()->id;
        $user = $this->profileService->getDetail($id);
        return view('admin.profile.index', compact('user'));
    }

    public function create(){
        $id = Auth::guard('admin')->user()->id;
        $user = $this->profileService->getDetail($id);
        return view('admin.profile.edit',compact('user'));
    }

    public function store(Request $request){
        $id = Auth::guard('admin')->user()->id;
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        if ($validator->fails()) {
            return redirect('/admin/profile/edit')
                ->withErrors($validator)
                ->withInput();
        }
        
        $user = $this->adminService->updateAdminUser($request, $id);
        return view('admin.profile.index', compact('user'));
    }
}
