<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthenticationController extends Controller
{
    /**
     * Show the login form.
     */
    public function showLoginForm()
    {
        return view('login'); // Point this to your login view file
    }

    /**
     * Handle the login request.
     */
    public function login(Request $request)
    {
        // Validate incoming request
        $validator = Validator::make($request->all(), [
            'email_or_phone' => 'required|string',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $credentials = $request->only('email_or_phone', 'password');

        // Check if input is email or phone and authenticate accordingly
        $login_type = filter_var($credentials['email_or_phone'], FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';

        if (Auth::attempt([$login_type => $credentials['email_or_phone'], 'password' => $credentials['password']])) {
            // Authentication passed
            return redirect()->route('portal.dashboard');
        }

        // Authentication failed
        return redirect()->back()
            ->withErrors(['email_or_phone' => 'Invalid email/phone or password.'])
            ->withInput();
    }

    /**
     * Handle user logout.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
