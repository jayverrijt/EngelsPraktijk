<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryCreationRequest extends FormRequest
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
            'categoryName' => ['required', 'unique:catlist'],
        ];
    }

    public function messages()
    {
        return [
            'categoryName.required' => 'The categoryName field is not present.',
            'categoryName.unique' => 'Category is already registered.',
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
