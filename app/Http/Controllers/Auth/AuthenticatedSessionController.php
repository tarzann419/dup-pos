<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ExpiryNotificationController; //These lines import the ExpiryNotificationController and StockMailController classes from their respective files
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Http\Controllers\StockMailController;


class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse //store method first validates the login request using the LoginRequest class
    {
        $request->authenticate(); //This process verifies the provided credentials against the user data stored in the system.

        // immediately after login, the function runs to check the commands; perform specific actions immediately after login. After that, it regenerates the session, sets a notification message in an array, and redirects the user to the intended home page with the notification data.
        StockMailController::stockMail();//These methods involve sending email notifications related to stock updates or expiry notifications.
        ExpiryNotificationController::sendExpiryNotification();

        $request->session()->regenerate();

        $notification = array(
            'message' => 'Admin Login Successfully',
            'alert-type' => 'info'
        );

        return redirect()->intended(RouteServiceProvider::HOME)->with($notification);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout(); //It logs out the user by calling the logout() method on the 'web' guard of the Auth facade. 

        $request->session()->invalidate(); //It then invalidates the session, regenerates a new session token, and redirects the user to the root path ('/').

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
