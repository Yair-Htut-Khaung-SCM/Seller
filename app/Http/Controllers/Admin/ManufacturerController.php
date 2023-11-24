<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ManufacturerStoreRequest;
use App\Http\Requests\Admin\ManufacturerUpdateRequest;
use App\Services\Admin\ManufacturerService;

class ManufacturerController extends Controller
{
    public function __construct(ManufacturerService $manufacturerService)
    {
        $this->manufacturerService = $manufacturerService;
    }

    public function index()
    {
        $manufacturers = $this->manufacturerService->getDetail();
        return view('admin.manufacturers.index', compact('manufacturers'));
    }

    public function create()
    {
        return view('admin.manufacturers.create');
    }

    public function store(ManufacturerStoreRequest $request)
    {
        $manufacturer = $this->manufacturerService->saveManufacturer($request);
        return redirect(route('admin.manufacturer.index'));
    }

    public function edit($id)
    {
        $manufacturer = $this->manufacturerService->getManufacturerById($id);
        return view('admin.manufacturers.edit', compact('manufacturer'));
    }

    public function update(ManufacturerUpdateRequest $request, $id)
    {
        $manufacturer = $this->manufacturerService->updateManufacturer($request, $id);
        return redirect(route('admin.manufacturer.index'));
    }

    public function destroy($id)
    {
        $manufacturer =  $this->manufacturerService->deleteManufacturer($id);
        return back();
    }
}
