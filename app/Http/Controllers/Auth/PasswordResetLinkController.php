<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $input_type = filter_var($request->input('input_type'), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $request->merge([$input_type => $request->input('input_type')]);
        
        $request->validate([
          'email' => ['required_without:username', 'email', 'exists:users,email'],
          'username' => ['required_without:email', 'string', 'exists:users,username'],
        ]);

        $status = Password::sendResetLink(
            $request->only($input_type)
        );

        return $status == Password::RESET_LINK_SENT
                    ? back()->with('status', __($status))
                    : back()->withInput($request->only($input_type))
                            ->withErrors([$input_type => __($status)]);
    }
}