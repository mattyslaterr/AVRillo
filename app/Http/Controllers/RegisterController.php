<?php

namespace App\Http\Controllers;

use App\Http\Requests\ActivateAccountRequest;
use App\Models\User;

class RegisterController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('auth.register');
    }

    /**
     * Activate a user account via token
     *
     * @param ActivateAccountRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function activate(ActivateAccountRequest $request)
    {
        // Check the token is validated & update the email verified at and token column
        if($request->validated()) {
            $activated = User::where('activation_token', $request->input('token'))->update([
                'email_verified_at' => now(),
                'activation_token' => null
            ]);
        }

        // Return view and send in activated flag to show message to user
        return view('auth.activate', [
            'activated' => $activated ?? false
        ]);
    }
}
