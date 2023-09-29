<?php

namespace App\Services;

use App\Http\Requests\RegisterRequest;
use App\Jobs\AccountVerification;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegistrationService
{
    /**
     * Register a user account
     *
     * @param RegisterRequest $request
     * @return void
     */
    public function registerAccount(array $data)
    {
        // Insert new user into the database
        $user = User::create([
            'name' => Arr::get($data, 'name'),
            'email' => Arr::get($data, 'email'),
            'password' => Hash::make(Arr::get($data, 'password')), // Generate password hash
            'activation_token' => Str::random(32) // Generate random token
        ]);

        $this->sendVerificationEmail($user->email, $user->activation_token);
    }

    /**
     * Dispatch job for verification email
     *
     * @param string $email
     * @param string $activation_token
     * @return void
     */
    private function sendVerificationEmail(string $email, string $activation_token)
    {
        AccountVerification::dispatch($email, $activation_token);
    }
}
