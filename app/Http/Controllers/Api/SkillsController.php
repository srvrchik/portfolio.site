<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use Illuminate\Http\Request;

class SkillsController extends Controller
{
    public function all()
    {
        $all = Skill::orderBy('id')->get();

        return response()->json($all);
    }

    public function store(Request $request)
    {
        $skill = Skill::create($request->all());

        return response()->json([
            'skill' => $skill
        ]);
    }

    public function skill($id)
    {
        $skill = Skill::findOrFail($id);

        return response()->json($skill);
    }

    public function update(Request $request, $id)
    {
        $skill = Skill::findOrFail($id);
        $skill->update($request->all());

        return response()->json($skill);
    }

    public function delete($id)
    {
        $skill = Skill::findOrFail($id);
        $skill->delete();
    }
}
