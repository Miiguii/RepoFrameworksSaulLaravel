<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    protected $maxAttempts = 5;
    protected $decayMinutes = 1;
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

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
        $this->middleware('auth')->only('logout');
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        logger()->warning('Intento de acceso fallido', [
            'email' => $request->input($this->username()),
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        throw ValidationException::withMessages([
            $this->username() => [trans('auth.failed')],
        ]);
    }
}
