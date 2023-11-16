<?php

namespace App\Http\Controllers\Admin;

use App\Models\Manufacturer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use App\Http\Requests\Admin\ManufacturerStoreRequest;
use App\Http\Requests\Admin\ManufacturerUpdateRequest;

class ManufacturerController extends Controller
{
    public function index()
    {
        $manufacturers = Manufacturer::paginate(10);

        return view('admin.manufacturers.index', compact('manufacturers'));
    }

    public function create()
    {
        return view('admin.manufacturers.create');
    }

    public function store(ManufacturerStoreRequest $request)
    {
        $manufacturer = new Manufacturer();

        $manufacturer->name = $request->name;

        $manufacturer->save();

        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $filename = $manufacturer->id. '.png';
            $file->move(public_path('/images/manufacturer_logos'),$filename);
        }
        return redirect(route('admin.manufacturer.index'));
    }

    public function edit($id)
    {
        $manufacturer = Manufacturer::find($id);

        return view('admin.manufacturers.edit', compact('manufacturer'));
    }

    public function update(ManufacturerUpdateRequest $request, $id)
    {
        $manufacturer = Manufacturer::find($id);
        
        $manufacturer->name = $request->name;
        $manufacturer->updated_at = now();

        $manufacturer->save();
        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $filename = $manufacturer->id. '.png';
            $file->move(public_path('/images/manufacturer_logos'),$filename);
        }

        return redirect(route('admin.manufacturer.index'));
    }

    public function destroy($id)
    {
        $manufacturer = Manufacturer::find($id);

        if(File::exists(public_path('/images/manufacturer_logos/' .$manufacturer->id. '.png'))) {
            File::delete(public_path('/images/manufacturer_logos/' .$manufacturer->id. '.png'));
          } 

        $manufacturer->delete();

        return back();
    }
}
