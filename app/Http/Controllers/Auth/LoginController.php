<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Zizaco\Entrust\Entrust;


class LoginController extends Controller
{
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

//    protected $maxAttempts = 1; // Default is 5
//    protected $lockoutTime = 3;
//    protected $decayMinutes = 1; // Default is 1

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
//    protected $user;
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function hasTooManyLoginAttempts(Request $request)
    {
        return $this->limiter()->tooManyAttempts(
            $this->throttleKey($request), 5, 1
        );
    }

    //function is overridden from AuthenticatesUsers.php trait
    public function login(Request $request)
    {
        if(!empty($request->redirectTo)){
            $this->redirectTo = $request->redirectTo;
            DB::table('metas')->where('key', $request->previousToken)->delete();

            DB::table('metas')->whereDate('created_at', '<', now())
                ->where('metable_type', '=', 'Temp')->delete();
//            dd($this->redirectTo);
        }
        $this->validateLogin($request);

        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        return $this->authenticated($request, $this->guard()->user())
            ?: redirect($this->redirectTo);
    }


    protected function authenticated(Request $request, $user)
    {
        if ($user->account_status == 0) {
            auth()->logout();
            // unset all session, as user has logged out
            session_unset();

            session()->flash('danger', 'Du kan ikke logge inn, kontoen din er deaktiv.');
            return back();
        }

        if (!is_null($user->deleted_at)) {
            auth()->logout();
            // unset all session, as user has logged out
            session_unset();

            session()->flash('danger', 'Du kan ikke logge inn, kontoen din er fjernet.');
            return back();
        }


        if (strpos($this->redirectTo, '/page/')){
            return redirect(url('/'));
        }
        return redirect($this->redirectTo);

//        return redirect()->intended($this->redirectPath());
    }

    public function logout(Request $request) {
        Auth::logout();
        return redirect('/');
    }
}
