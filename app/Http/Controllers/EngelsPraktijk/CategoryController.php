<?php

namespace App\Http\Controllers\EngelsPraktijk;

use App\Models\CatList;
use App\Http\Controllers\Controller;
use App\Http\Requests\Combined\CategoryModificationRequest;

class CategoryController extends Controller
{
    public function index() {
        $categories = Catlist::all();

        return $categories;
    }

    public function store(CategoryModificationRequest $request) {
        $validatedRequest = $request->validated();

        $category = Catlist::create($validatedRequest);
        return $category;
    }

    public function show($categoryId) {
        $category = Catlist::find($categoryId);

        if ($category == null) {
            return response()->json(['message' => 'Category not found.'], 404);
        }

        return $category;
    }

    public function update(CategoryModificationRequest $request, $categoryId) {
        $validatedRequest = $request->validated();
        $category = CatList::find($categoryId);

        if ($category == null) {
            return response()->json(['message' => 'Category not found.'], 404);
        }

        $category->category_name = $validatedRequest['category_name'];
        $category->save();

        return $category;
    }

    public function destroy($categoryId) {
        $category = Catlist::find($categoryId);

        if ($category == null) {
            return response()->json(['message' => 'Category not found.'], 404);
        }
        else if ($category->id == 1 || $category-> id == 2) {
            return response()->json(['message', 'This category cannot be deleted.'], 400);
        }

        $category->delete();
        return response()->json(['message' => 'Category deleted.'], 204);
    }
}
