<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'unit_type_id' => 'required|exists:unit_types,id',
            'living_rooms' => 'nullable|integer',
            'bedrooms' => 'nullable|integer',
            'title' => 'nullable',
            'bathrooms' => 'nullable|integer',
            'area' => 'required|integer',
            'price' => 'required|numeric',
            'status' => 'nullable|in:available,sold,reserved',
        ]);

        return response()->json(Unit::create($data), 201);
    }

    public function destroy(Unit $unit)
    {
        $unit->delete();

        return response()->json(null, 204);
    }
}
