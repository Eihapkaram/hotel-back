<?php

namespace App\Http\Controllers;

use App\Models\ProjectFeature;
use Illuminate\Http\Request;

class ProjectFeaturesController extends Controller
{
    public function index()
    {
        return ProjectFeature::all();
    }

    public function store(Request $request)
    {
        $feature = ProjectFeature::create($request->all());

        return response()->json($feature, 201);
    }

    public function show(ProjectFeature $projectFeature)
    {
        return $projectFeature;
    }

    public function update(Request $request, ProjectFeature $projectFeature)
    {
        $projectFeature->update($request->all());

        return response()->json($projectFeature);
    }

    public function destroy(ProjectFeature $projectFeature)
    {
        $projectFeature->delete();

        return response()->json(null, 204);
    }
}
