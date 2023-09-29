<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Jobs\AccountVerification;
use App\Models\User;
use App\Services\RegistrationService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegisterApiController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegisterRequest $request)
    {
        // Register account using service
        $service = new RegistrationService();
        $service->registerAccount($request->validated());

        // Friendly response message
        return response()->json('Register successful');
    }
}
