<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
<<<<<<< HEAD
     * Get the login username to be used by the controller.
     *
     * @return string
=======
     * Override username to use user_ic instead of email
>>>>>>> ca153fa75f3e26a9b86fd114a2fc06a15b34278f
     */
    public function username()
    {
        return 'user_ic';
    }
<<<<<<< HEAD
=======

    /**
     * Optional: override login to show correct error message
     */
    protected function attemptLogin(Request $request)
    {
        return Auth::attempt(
            $this->credentials($request),
            $request->filled('remember')
        );
    }

    protected function credentials(Request $request)
    {
        return $request->only('user_ic', 'password');
    }
>>>>>>> ca153fa75f3e26a9b86fd114a2fc06a15b34278f
}
