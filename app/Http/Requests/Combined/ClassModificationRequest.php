<?php

namespace App\Http\Requests\Combined;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ClassModificationRequest extends FormRequest
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
        $questionId = $this->route('class');

        return [
            'class_name' => ['required', Rule::unique('classes')->ignore($questionId)],
            'level_id' => ['required', 'exists:levels,id'],
        ];
    }

    public function messages()
    {
        return [
            'class_name.required' => 'The class_name field is not present.',
            'class_name.unique' => 'Class already exists.',
            'level_id.required' => 'Level not specified.',
            'level_id.exists' => 'Level could not be found.',
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
