<?php

namespace App\Http\Controllers\Admin;

use App\Models\BuildType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BuildTypeStoreRequest;
use App\Http\Requests\Admin\BuildTypeUpdateRequest;

class BuildTypeController extends Controller
{
    public function index()
    {
        $build_types = BuildType::paginate(10);

        return view('admin.build_types.index', compact('build_types'));
    }

    public function create()
    {
        return view('admin.build_types.create');
    }

    public function store(BuildTypeStoreRequest $request)
    {
        $build_type = new BuildType();

        $build_type->name = $request->name;

        $build_type->save();

        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $filename = $build_type->id. '.png';
            $file->move(public_path('/images/build_types'),$filename);
        }

        return redirect(route('admin.build-type.index'));
    }

    public function edit($id)
    {
        $build_type = BuildType::find($id);

        return view('admin.build_types.edit', compact('build_type'));
    }

    // BuildTypeUpdateRequest
    public function update(BuildTypeUpdateRequest $request, $id)
    {
        $build_type = BuildType::find($id);
        $build_type->name = $request->name;
        $build_type->updated_at = now();

        $build_type->save();

        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $filename = $build_type->id. '.png';
            $file->move(public_path('/images/build_types'),$filename);
        }

        $build_types = BuildType::all();

        return view('admin.build_types.index', compact('build_types'));
    }

    public function destroy($id)
    {
        $build_type = BuildType::find($id);

        if(File::exists(public_path('/images/build_types/' .$build_type->id. '.png'))) {
            File::delete(public_path('/images/build_types/' .$build_type->id. '.png'));
          } 

        $build_type->delete();

        return back();
    }
}
