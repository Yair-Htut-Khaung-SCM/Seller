<?php

namespace App\Http\Controllers\Admin;

use App\Models\AdminUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function index(){
        $id = Auth::guard('admin')->user()->id;
        $user = AdminUser::where('id', $id)->first();
        return view('admin.profile.index', compact('user'));
    }
    public function create(){
        $id = Auth::guard('admin')->user()->id;
        $user = AdminUser::where('id', $id)->first();
        return view('admin.profile.edit',compact('user'));
    }
    public function store(Request $request){
        $id = Auth::guard('admin')->user()->id;
        $user = AdminUser::find($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        if ($validator->fails()) {
            return redirect('/admin/profile/edit')
                ->withErrors($validator)
                ->withInput();
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        return view('admin.profile.index', compact('user'));
    }
}
