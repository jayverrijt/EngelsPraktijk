<?php

namespace App\Http\Controllers\EngelsPraktijk;

use App\Http\Controllers\Controller;
use App\Http\Requests\Combined\ClassModificationRequest;
use App\Models\Cls;

class ClassController extends Controller
{
    public function index() {
        $classes = Cls::all();

        return $classes;
    }

    public function store(ClassModificationRequest $request) {
        $validatedRequest = $request->validated();

        $class = Cls::create($validatedRequest);
        return $class;
    }

    public function show($classId) {
        $class = Cls::find($classId);

        if ($class == null) {
            return response()->json(['message' => 'Class not found.'], 404);
        }

        return $class;
    }

    public function update(ClassModificationRequest $request, $classId) {
        $validatedRequest = $request->validated();
        $class = Cls::find($classId);

        if ($class == null) {
            return response()->json(['message' => 'Class not found.'], 404);
        }

        $class->class_name = $validatedRequest['class_name'];
        $class->level_id = $validatedRequest['level_id'];
        $class->save();

        return $class;
    }

    public function destroy($classId) {
        $class = Cls::find($classId);

        if ($class == null) {
            return response()->json(['message' => 'Class not found.'], 404);
        }

        $class->delete();
        return response()->json(['message' => 'Class deleted.'], 204);
    }
}
