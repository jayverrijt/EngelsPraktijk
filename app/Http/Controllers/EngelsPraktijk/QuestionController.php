<?php

namespace App\Http\Controllers\EngelsPraktijk;

use App\Models\Question;
use App\Http\Controllers\Controller;
use App\Http\Requests\Combined\QuestionModificationRequest;

class QuestionController extends Controller
{
    public function index() {
        $questions = Question::all();

        return $questions;
    }

    public function store(QuestionModificationRequest $request) {
        $validatedRequest = $request->validated();

        $question = Question::create($validatedRequest);
        return $question;
    }

    public function show($questionId) {
        $question = Question::find($questionId);

        if ($question == null) {
            return response()->json(['message' => 'Question not found.'], 404);
        }

        return $question;
    }

    public function update(QuestionModificationRequest $request, $questionId) {
        $validatedRequest = $request->validated();
        $question = Question::find($questionId);

        if ($question == null) {
            return response()->json(['message' => 'Question not found.'], 404);
        }

        $question->question = $validatedRequest['question'];
        $question->answer = $validatedRequest['answer'];
        $question->category_id = $validatedRequest['category_id'];;
        $question->level_id = $validatedRequest['level_id'];

        $question->save();

        return $question;
    }

    public function destroy($questionId) {
        $question = Question::find($questionId);

        if ($question == null) {
            return response()->json(['message' => 'Question not found.'], 404);
        }

        $question->delete();

        return response()->json(['message' => 'Question deleted.'], 200);
    }
}
