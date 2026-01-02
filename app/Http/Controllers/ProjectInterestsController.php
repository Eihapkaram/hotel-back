<?php

namespace App\Http\Controllers;

use App\Models\ProjectInterest;
use Illuminate\Http\Request;

class ProjectInterestController extends Controller
{
    public function index()
    {
        return ProjectInterest::all();
    }

    public function store(Request $request)
    {
        $interest = ProjectInterest::create($request->all());

        return response()->json($interest, 201);
    }

    public function show(ProjectInterest $projectInterest)
    {
        return $projectInterest;
    }

    public function update(Request $request, ProjectInterest $projectInterest)
    {
        $projectInterest->update($request->all());

        return response()->json($projectInterest);
    }

    public function destroy(ProjectInterest $projectInterest)
    {
        $projectInterest->delete();

        return response()->json(null, 204);
    }
}
