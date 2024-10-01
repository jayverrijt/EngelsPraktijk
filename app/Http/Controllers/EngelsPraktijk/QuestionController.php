<?php

namespace App\Http\Controllers\EngelsPraktijk;

use App\Models\Question;
use App\Http\Controllers\Controller;
use App\Http\Requests\Combined\QuestionModificationRequest;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isEmpty;

class QuestionController extends Controller
{
    // Cat 2 = Yes/No
    // Cat 1 = Open
    public function index(Request $request) {
        $categoryId = $request->query('category');
        $questions = new Question();

        if ($categoryId == null) {
            $questions = $questions->findAll();
        }
        else {
            $questions = $questions->findQuestions($categoryId);
        }

        return $questions;
    }

    public function store(QuestionModificationRequest $request) {
        $validatedRequest = $request->validated();

        $question = new Question();
        $question = $question->addQuestion($validatedRequest);
        
        return $question;
    }

    public function show(Request $request, $questionId) {
        $categoryId = $request->query('category');

        if ($categoryId == null) {
            return response()->json(['message' => 'Category not specified.'], 422);
        }

        $question = new Question();
        $question = $question->findQuestion($questionId, $categoryId);

        if ($question == null) {
            return response()->json(['message' => 'Question not found.'], 404);
        }

        return $question;
    }

    public function update(QuestionModificationRequest $request, $questionId) {
        // $validatedRequest = $request->validated();
        // $question = Question::find($questionId);

        // if ($question == null) {
        //     return response()->json(['message' => 'Question not found.'], 404);
        // }

        // $question->question = $validatedRequest['question'];
        // $question->answer = $validatedRequest['answer'];
        // $question->category_id = $validatedRequest['category_id'];;
        // $question->level_id = $validatedRequest['level_id'];

        // $question->save();

        // return $question;
        return response()->json(['message' => 'Not yet implemented!'], 501);
    }

    public function destroy(Request $request, $questionId) {
        $categoryId = $request->query('category');

        if ($categoryId == null) {
            return response()->json(['message' => 'Category not specified.'], 422);
        }

        $question = new Question();
        $question = $question->findQuestion($questionId, $categoryId);

        if ($question == null) {
            return response()->json(['message' => 'Question not found.'], 404);
        }

        $question->delete();
        
        return response()->json(['message' => 'Question deleted.'], 204);
    }
}
