<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginApiController extends Controller
{
    /**
     * Authenticate user into account
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request)
    {
        // Attempt login using credentials and initiate session
        if (Auth::attempt($request->validated())) {
            $request->session()->regenerate();

            return response()->json('Login success');
        }

        // Friendly response message
        return response()->json(['Your password is incorrect'], 401);
    }
}
