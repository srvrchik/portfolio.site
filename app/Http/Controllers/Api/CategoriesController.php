<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    //
    public function all()
    {
        $all = Category::orderBy('id', 'desc')->get();

        return response()->json($all);
    }

    public function store(Request $request)
    {
        $category = Category::create($request->all());

        return response()->json($category);
    }

    public function one($id)
    {
        $category = Category::findOrFail($id);

        return response()->json($category);
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $category->update($request->all());

        return response()->json($category);
    }

    public function delete($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

    }
}
