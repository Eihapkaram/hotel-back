<?php

namespace App\Http\Controllers;

use App\Models\ProjectLocation;
use Illuminate\Http\Request;

class ProjectLocationController extends Controller
{
    public function index()
    {
        return ProjectLocation::all();
    }

    public function store(Request $request)
    {
        $location = ProjectLocation::create($request->all());

        return response()->json($location, 201);
    }

    public function show(ProjectLocation $projectLocation)
    {
        return $projectLocation;
    }

    public function update(Request $request, ProjectLocation $projectLocation)
    {
        $projectLocation->update($request->all());

        return response()->json($projectLocation);
    }

    public function destroy(ProjectLocation $projectLocation)
    {
        $projectLocation->delete();

        return response()->json(null, 204);
    }
}
