<?php

namespace App\Service;

use App\Models\Question;
use Illuminate\Support\Facades\DB;

class QuestionService
{
    public function findQuestion($questionId, $categoryId) {
        $question = new Question();
        $question = $this->getCorrectTable($question, $categoryId);

        $question = $question->find($questionId);
        return $question;
    }

    public function findQuestions($categoryId, $random, $limit) {
        $question = new Question();
        $question = $this->getCorrectTable($question, $categoryId);                 

        if ($random) {
            $questions = $question->newQuery()->inRandomOrder()->limit($limit)->get();
        }
        else {
            $questions = $question->newQuery()->limit($limit)->get();
        }
        
        return $questions;        
    }

    public function findAll($random, $limit) {
        $possibleIds = [1, 2];
        $questions = [];
        $question = new Question();

            foreach ($possibleIds as $categoryId) {
                $question = $this->getCorrectTable($question, $categoryId);
                $tempQuestions = $question->newQuery()->limit($limit)->get();
    
                foreach ($tempQuestions as $tempQuestion) {
                    array_push($questions, $tempQuestion);
                }
            }

        return $questions;
    }

    function getRandomQuestions($maxAmount) {
        $counts = [];
        $tables = ['questions', 'questionsyn'];
        
        foreach ($tables as $table) {
            $counts[$table] = DB::table($table)->count();
        }
    
        $randomAmounts = [];
        $remainingAmount = $maxAmount;
    
        foreach ($tables as $table) {
            $maxFromTable = min($remainingAmount, $counts[$table]);
            
            $randomAmount = rand(0, $maxFromTable);
    
            $randomAmounts[$table] = $randomAmount;
            $remainingAmount -= $randomAmount;
    
            if ($remainingAmount <= 0) {
                break;
            }
        }
    
        foreach ($tables as $table) {
            if ($remainingAmount <= 0) {
                break;
            }
    
            $availableToFetch = min($counts[$table] - $randomAmounts[$table], $remainingAmount);
            $randomAmounts[$table] += $availableToFetch;
            $remainingAmount -= $availableToFetch;
        }
    
        $records = collect();
        foreach ($tables as $table) {
            $recordsFromTable = DB::table($table)->inRandomOrder()->limit($randomAmounts[$table])->get();
            $records = $records->merge($recordsFromTable);
        }
    
        return $records;
    }

    public function addQuestion($validatedRequest) {
        if ($validatedRequest['answer'] == "y" || $validatedRequest['answer'] == "n") {
            // Manually create Question as a different table is needed.
            $question = new Question();
            $question->setTable('questionsyn');

            $validatedRequest['category_id'] = 2;

            $question->fill($validatedRequest);
            $question->save();

            return $question;
        }
        else {
            // Simple way, default table.
            if ($validatedRequest['category_id'] = 2) {
                $validatedRequest['category_id'] = 1;
            }

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

}
