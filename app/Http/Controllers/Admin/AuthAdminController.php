<?php

namespace App\Http\Controllers\Admin;

use App\UserAdmin;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Lang;
use Auth;
use Illuminate\Http\Request;

class AuthAdminController extends Controller
{

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    public $loginPath = '/index/login';
    public $redirectPath = '/index/dashboard';
    public $redirectAfterLogout = '/index/login';
    protected $username = 'nip';


    public function getLogin()
    {
        return view('auth.admin.login');
    }

    protected function getFailedLoginMessage() {
        return Lang::has('auth.failed')
        ? Lang::get('auth.failed')
        : 'NIP atau Password salah';
    }

    public function __construct()
    {
        $this->middleware('guest.admin', ['except' => 'getLogout']);

    }

    public function redirectPath()
    {
        if (property_exists($this, 'redirectPath'))
        {
            return $this->redirectPath;
        }
        return property_exists($this, 'redirectTo') ? $this->redirectTo : '/index/login';
    }

    public function getLogout()
    {
        Auth::admin()->logout();
        Flash()->success('Anda berhasil Logout!');
        return redirect(property_exists($this, 'redirectAfterLogout') ? $this->redirectAfterLogout : '/');
    }

    public function postLogin(Request $request)
    {
        $this->validate($request, [
            $this->loginUsername() => 'required', 'password' => 'required',
        ]);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        $throttles = $this->isUsingThrottlesLoginsTrait();

        if ($throttles && $this->hasTooManyLoginAttempts($request)) {
            return $this->sendLockoutResponse($request);
        }

        $credentials = $this->getCredentials($request);

        if (Auth::admin()->attempt($credentials, $request->has('remember'))) {
            return redirect()->intended('/index/dashboard');
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        if ($throttles) {
            $this->incrementLoginAttempts($request);
        }

        return redirect($this->loginPath())
            ->withInput($request->only($this->loginUsername(), 'remember'))
            ->withErrors([
                $this->loginUsername() => $this->getFailedLoginMessage(),
            ]);
    }

    protected function handleUserWasAuthenticated(Request $request, $throttles)
    {
        if ($throttles) {
            $this->clearLoginAttempts($request);
        }

        if (method_exists($this, 'authenticated')) {
            return $this->authenticated($request, Auth::admin());
        }
        return redirect()->intended($this->redirectPath());
    }
}
