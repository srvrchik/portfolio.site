<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Projects;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function all()
    {
        return Projects::orderBy('id', 'desc')->get();
    }

    public function store(Request $request)
    {
        $project = Projects::create($request->all());
        $project->uploadImage($request->file('file'));

        return response()->json($project);
    }

    public function one(Request $request, $id)
    {
        $project = Projects::findOrFail($id);

        return response()->json($project);
    }

    public function removeImage(Request $request, $id)
    {
        $project = Projects::findOrFail($id);
        $project->removeImage();

        return response()->json($project);
    }

    public function update(Request $request, $id)
    {
        $project = Projects::findOrFail($id);
        $project->update($request->all());
        $project->uploadImage($request->file('file'));

        return response()->json($project);
    }

    public function delete($id)
    {
        $project = Projects::findOrFail($id);
        $project->removeImage();
        $project->delete();

    }
}
