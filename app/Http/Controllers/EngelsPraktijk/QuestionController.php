<?php

namespace App\Http\Controllers\EngelsPraktijk;

use App\Models\Question;
use App\Http\Controllers\Controller;
use App\Http\Requests\Combined\QuestionModificationRequest;
use App\Service\QuestionService;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isEmpty;

class QuestionController extends Controller
{
    protected $questionService;

    public function __construct(QuestionService $questionService)
    {
        $this->questionService = $questionService;
    }

    // Cat 2 = Yes/No
    // Cat 1 = Open
    public function index(Request $request) {
        $categoryId = $request->query('category');

        if ($categoryId == null) {
            $questions = $this->questionService->findAll(false, 1000);
        }
        else {
            $questions = $this->questionService->findQuestions($categoryId, false, 1000);
        }

        return $questions;
    }

    public function temp() {
        for ($i = 0; $i < 100; $i++) {
            $request = [];
            $request['question'] = fake()->sentence();

            $random = rand(0, 100);
            if ($random > 50) {
                $request['answer'] = fake()->sentence();
            }
            else {
                $random = rand(0, 100);
                if ($random > 50) {
                    $request['answer'] = 'y';
                }
                else {
                    $request['answer'] = 'n';
                }
            }
            $request['level_id'] = 1;

            $question = new Question();
            $question->addQuestion($request);
        }
    }

    public function store(QuestionModificationRequest $request) {
        $validatedRequest = $request->validated();

        $question = $this->questionService->addQuestion($validatedRequest);
        
        return $question;
    }

    public function show(Request $request, $questionId) {
        $categoryId = $request->query('category');

        if ($categoryId == null) {
            return response()->json(['message' => 'Category not specified.'], 422);
        }

        $question = $this->questionService->findQuestion($questionId, $categoryId);

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

        $question = $this->questionService->findQuestion($questionId, $categoryId);

        if ($question == null) {
            return response()->json(['message' => 'Question not found.'], 404);
        }

        $question->delete();
        
        return response()->json(['message' => 'Question deleted.'], 204);
    }

    public function printPdf(Request $request) {
        $categories = $request->input('categories', []);
        $limit = $request->query('limit');
        $questions = [];

        if ($categories != null) {
            foreach ($categories as $category => $amount) {
                $retrievedQuestions = $this->questionService->findQuestions($category, true, $amount);

                foreach ($retrievedQuestions as $retrievedQuestion) {
                    array_push($questions, $retrievedQuestion);
                }
            }
        }
        else {
            $retrievedQuestions = $this->questionService->getRandomQuestions($limit);

            foreach ($retrievedQuestions as $retrievedQuestion) {
                array_push($questions, $retrievedQuestion);
            }
        }

        return $questions;        
    }
}
