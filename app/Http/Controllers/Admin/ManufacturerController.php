<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ManufacturerStoreRequest;
use App\Http\Requests\Admin\ManufacturerUpdateRequest;
use App\Models\Manufacturer;
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

    public function edit(Manufacturer $manufacturer)
    {
        return view('admin.manufacturers.edit', compact('manufacturer'));
    }

    public function update(ManufacturerUpdateRequest $request, Manufacturer $manufacturer)
    {
        $manufacturer = $this->manufacturerService->updateManufacturer($request, $manufacturer);
        return redirect(route('admin.manufacturer.index'));
    }

    public function destroy(Manufacturer $manufacturer)
    {
        $manufacturer =  $this->manufacturerService->deleteManufacturer($manufacturer);
        return back();
    }
}
