<?php

namespace App\Http\Controllers\EngelsPraktijk;

use App\Http\Controllers\Controller;
use App\Http\Requests\Combined\LevelModificationRequest;
use App\Models\Level;

class LevelController extends Controller
{
    public function index() {
        $levels = Level::all();

        return $levels;
    }

    public function store(LevelModificationRequest $request) {
        $validatedRequest = $request->validated();

        $level = Level::create($validatedRequest);
        return $level;
    }

    public function show($categoryId) {
        $category = Level::find($categoryId);

        if ($category == null) {
            return response()->json(['message' => 'Level not found.'], 404);
        }

        return $category;
    }

    public function update(LevelModificationRequest $request, $levelId) {
        $validatedRequest = $request->validated();
        $level = Level::find($levelId);

        if ($level == null) {
            return response()->json(['message' => 'Level not found.'], 404);
        }

        $level->level_name = $validatedRequest['level_name'];
        $level->save();

        return $level;
    }

    public function destroy($levelId) {
        $level = Level::find($levelId);

        if ($level == null) {
            return response()->json(['message' => 'Level not found.'], 404);
        }

        $level->delete();
        return response()->json(['message' => 'Level deleted.'], 200);
    }
}
