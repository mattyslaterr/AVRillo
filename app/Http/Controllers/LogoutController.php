<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    /**
     * Logout user from account
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        // Delete session & logout user
        Auth::logout();

        // Redirect to logout
        return redirect()->route('login');
    }
}
