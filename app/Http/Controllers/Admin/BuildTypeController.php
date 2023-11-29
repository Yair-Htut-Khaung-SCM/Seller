<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BuildTypeStoreRequest;
use App\Http\Requests\Admin\BuildTypeUpdateRequest;
use App\Models\BuildType;
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

    public function edit(BuildType $build_type)
    {
        return view('admin.build_types.edit', compact('build_type'));
    }

    public function update(BuildTypeUpdateRequest $request, BuildType $build_type)
    {
        $build_type = $this->buildTypeService->updateBuildType($request, $build_type);
        return redirect(route('admin.build-type.index'));
    }

    public function destroy(BuildType $build_type)
    {
        $build_type =  $this->buildTypeService->deleteBuildType($build_type);
        return back();
    }
}
