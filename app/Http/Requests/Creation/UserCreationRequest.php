<?php

namespace App\Http\Requests\Creation;

use Illuminate\Foundation\Http\FormRequest;

class UserCreationRequest extends FormRequest
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
            'name' => ['required', 'unique:users'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:8'],
            'class_id' => [],
            'type' => [],
        ];
    }


    public function messages()
    {
        return [
            'name.required' => 'The name field is not present.',
            'name.unique' => 'Name is already registered.',
            'email.required' => 'The email field is not present.',
            'email.email' => 'Email is not a email.',
            'email.unique' => 'Email is already registered.',
            'password.required' => 'The password field is not present.',
            'password.min' => 'Password length must be more then 8.',
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
