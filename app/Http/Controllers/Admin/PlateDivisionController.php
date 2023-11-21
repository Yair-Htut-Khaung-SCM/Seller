<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PlateDivisionStoreRequest;
use App\Services\Admin\PlateDivisionService;

class PlateDivisionController extends Controller
{
    public function __construct(PlateDivisionService $plateDivisionService)
    {
        $this->plateDivisionService = $plateDivisionService;
    }

    public function index()
    {
        $plate_divisions = $this->plateDivisionService->getDetail();
        return view('admin.plate_divisions.index', compact('plate_divisions'));
    }

    public function create()
    {
        return view('admin.plate_divisions.create');
    }

    public function store(PlateDivisionStoreRequest $request)
    {
        $plate_division = $this->plateDivisionService->savePlateDivision($request);
        return redirect(route('admin.plate-division.index'));
    }

    public function edit($id)
    {
        $plate_division = $this->plateDivisionService->getPlateDivisionById($id);
        return view('admin.plate_divisions.edit', compact('plate_division'));
    }

    public function update(PlateDivisionStoreRequest $request, $id)
    {
        $plate_division = $this->plateDivisionService->updatePlateDivision($request, $id);
        return redirect(route('admin.plate-division.index'));
    }

    public function destroy($id)
    {
        $plate_division =  $this->plateDivisionService->deletePlateDivision($id);
        return back();
    }
}
