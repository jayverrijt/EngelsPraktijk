<?php

namespace App\Http\Requests\Combined;

use Illuminate\Foundation\Http\FormRequest;

class LevelModificationRequest extends FormRequest
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
        return [
            'level_name' => ['required', 'unique:levels'],
        ];
    }

    public function messages()
    {
        return [
            'level_name.required' => 'The level_name field is not present.',
            'level_name.unique' => 'Level already exists.',
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
