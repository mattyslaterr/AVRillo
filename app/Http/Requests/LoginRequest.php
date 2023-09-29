<?php

namespace App\Http\Requests;

use App\Rules\AccountActivated;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;

class LoginRequest extends FormRequest
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
            'email' => ['required', 'email', 'exists:users,email', new AccountActivated()],
            'password' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'You must enter an email address',
            'email.email' => 'Your email address is not valid',
            'email.exists' => 'An account under this email address does not exist',
            'password.required' => 'You must enter a password',
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
