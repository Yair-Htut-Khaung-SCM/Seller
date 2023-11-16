<?php

namespace App\Http\Controllers\Admin;

use App\Models\PlateDivision;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PlateDivisionStoreRequest;

class PlateDivisionController extends Controller
{
    public function index()
    {
        $plate_divisions = PlateDivision::paginate(10);

        return view('admin.plate_divisions.index', compact('plate_divisions'));
    }

    public function create()
    {
        return view('admin.plate_divisions.create');
    }

    public function store(PlateDivisionStoreRequest $request)
    {
        $plate_division = new PlateDivision();

        $plate_division->name = $request->name;

        $plate_division->save();

        return redirect(route('admin.plate-division.index'));
    }

    public function edit($id)
    {
        $plate_division = PlateDivision::find($id);

        return view('admin.plate_divisions.edit', compact('plate_division'));
    }

    public function update(PlateDivisionStoreRequest $request, $id)
    {
        $plate_division = PlateDivision::find($id);

        $plate_division->name = $request->name;
        $plate_division->updated_at = now();

        $plate_division->save();

        $plate_divisions = PlateDivision::all();

        return view('admin.plate_divisions.index', compact('plate_divisions'));
    }

    public function destroy($id)
    {
        $plate_division = PlateDivision::find($id);

        $plate_division->delete();

        return back();
    }
}
