<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ActivateAccountRequest extends FormRequest
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
            'token' => ['exists:users,activation_token']
        ];
    }
}
