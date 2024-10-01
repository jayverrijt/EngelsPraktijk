<?php

namespace App\Http\Requests\Combined;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class QuestionModificationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $questionId = $this->route('question');
    
        return [
            'question' => [
                'required', 
                Rule::unique('questions')->ignore($questionId), 
                Rule::unique('questionsyn')->ignore($questionId),
            ],            
            'answer' => [],
            'category_id' => ['required', 'exists:catlist,id'],
            'level_id' => ['required', 'exists:levels,id'],
        ];
    }


    public function messages()
    {
        return [
            'question.required' => 'The question field is not present.',
            'question.unique' => 'Question already exists.',
            'category_id.required' => 'The category_id field is not present.',
            'category_id.exists' => 'category_id could not be found.',
            'level_id.required' => 'The level_id field is not present.',
            'level_id.exists' => 'level_id could not be found.',
        ];
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        $response = response()->json([
            'success' => false,
            'message' => 'Bad Request',
            'errors' => $validator->errors()
        ], 400);

        throw new \Illuminate\Validation\ValidationException($validator, $response);
    }
}
