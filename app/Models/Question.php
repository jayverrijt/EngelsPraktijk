<?php

namespace App\Models;

use GuzzleHttp\Psr7\Query;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'question',
        'answer',
        'category_id',
        'level_id',
    ];

    public function findQuestion($questionId, $categoryId) {
        $question = new Question();
        $question = $this->getCorrectTable($question, $categoryId);

        $question = $question->find($questionId);
        return $question;
    }

    public function findQuestions($categoryId) {
        $question = new Question();

        $question = $this->getCorrectTable($question, $categoryId);
        $questions = $question->newQuery()->get(); 
        
        return $questions;        
    }

    public function findAll() {
        $possibleIds = [1, 2];
        $questions = [];

        foreach ($possibleIds as $categoryId) {
            $question = new Question();

            $question = $this->getCorrectTable($question, $categoryId);
            $tempQuestions = $question->newQuery()->get();

            foreach ($tempQuestions as $tempQuestion) {
                array_push($questions, $tempQuestion);
            }
        }

        return $questions;
    }

    public function addQuestion($validatedRequest) {
        if ($validatedRequest['answer'] == "y" || $validatedRequest['answer'] == "n") {
            // Manually create Question as a different table is needed.
            $question = new Question();
            $question->setTable('questionsyn');
            $question->fill($validatedRequest);
            
            $question->save();
            return $question;
        }
        else {
            // Simple way, default table.
            $question = Question::create($validatedRequest);

            return $question;
        }
    }

    private function getCorrectTable($question, $categoryId) {
        switch ($categoryId) {
            case 1:
                $question->setTable('questions');
                break;
            case 2:
                $question->setTable('questionsyn');
                break;
            default: 
                $question->setTable('questions');
                break;        
        }

        return $question;
    }

    public function categories() {
        return $this->hasOne(Catlist::class, 'category_id');
    }

    public function levels() {
        return $this->hasOne(Level::class, 'level_id');
    }
}
