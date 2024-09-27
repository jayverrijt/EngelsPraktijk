<?php

namespace App\Http\Controllers\EngelsPraktijk;

use App\Models\CatList;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryCreationRequest;

class CategoryController extends Controller
{
    public function index() {
        $categories = Catlist::all();

        return $categories;
    }

    public function store(CategoryCreationRequest $request) {
        $validatedRequest = $request->validated();

        $category = Catlist::create($validatedRequest);
        return $category;
    }

    public function show($categoryId) {
        $category = Catlist::find($categoryId);

        if ($category == null) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        return $category;
    }

    public function destroy($categoryId) {
        $category = Catlist::find($categoryId);

        if ($category == null) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        return response()->json(['message' => 'Category Deleted'], 200);
    }
}
