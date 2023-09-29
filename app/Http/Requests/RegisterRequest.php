<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * Check the user is not already logged in
     *
     * @return bool
     */
    public function authorize()
    {
        return !Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:28'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'confirmed'],
            'password_confirmation' => ['required']
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'You must enter a name',
            'name.string' => 'Name must be a string',
            'name.max' => 'Name must be a maximum of 28 characters',
            'email.required' => 'You must enter an email address',
            'email.email' => 'Your email address is not valid',
            'email.exists' => 'An account already exists under this email address',
            'password.required' => 'You must enter a password',
            'password.confirmed' => 'Your passwords do not match',
            'password_confirmation.required' => 'You must re-enter your password',
        ];
    }

    /**
     * Return friendly error messages
     *
     * @param \Illuminate\Contracts\Validation\Validator $validator
     * @return mixed
     */
    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator) {
        throw new HttpResponseException(response()->json($validator->errors()->all(), 422));
    }
}
