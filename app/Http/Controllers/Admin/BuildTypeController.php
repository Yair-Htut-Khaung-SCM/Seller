<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BuildTypeStoreRequest;
use App\Http\Requests\Admin\BuildTypeUpdateRequest;
use App\Services\Admin\BuildTypeService;

class BuildTypeController extends Controller
{
    public function __construct(BuildTypeService $buildTypeService)
    {
        $this->buildTypeService = $buildTypeService;
    }

    public function index()
    {
        $build_types = $this->buildTypeService->getDetail();
        return view('admin.build_types.index', compact('build_types'));
    }

    public function create()
    {
        return view('admin.build_types.create');
    }

    public function store(BuildTypeStoreRequest $request)
    {
        $build_type = $this->buildTypeService->saveBuildType($request);
        return redirect(route('admin.build-type.index'));
    }

    public function edit($id)
    {
        $build_type = $this->buildTypeService->getBuildTypeById($id);
        return view('admin.build_types.edit', compact('build_type'));
    }

    // BuildTypeUpdateRequest
    public function update(BuildTypeUpdateRequest $request, $id)
    {
        $build_type = $this->buildTypeService->updateBuildType($request, $id);
        return redirect(route('admin.build-type.index'));
    }

    public function destroy($id)
    {
        $build_type =  $this->buildTypeService->deleteBuildType($id);
        return back();
    }
}
