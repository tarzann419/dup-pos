<?php

namespace App\Http\Controllers\Auth;
//These lines import the necessary classes and dependencies that will be used within the AuthenticatedSessionController class
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class ConfirmablePasswordController extends Controller
{
    /**
     * Show the confirm password view. 
     */
    public function show(): View
    {
        return view('auth.confirm-password');
    }

    /**
     * Confirm the user's password.
     */
    public function store(Request $request): RedirectResponse
    {
        if (! Auth::guard('web')->validate([ //validates password or confirm
            'email' => $request->user()->email,
            'password' => $request->password,
        ])) {
            throw ValidationException::withMessages([ //if validation fails it throws an exception
                'password' => __('auth.password'),
            ]);
        }

        $request->session()->put('auth.password_confirmed_at', time()); //If the validation succeeds, it stores the timestamp of the password confirmation in the session 

        return redirect()->intended(RouteServiceProvider::HOME);//redirects users to home page
    }
}
