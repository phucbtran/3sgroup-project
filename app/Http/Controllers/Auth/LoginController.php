<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request){
        $remember = ($request->input('remember')) ? true : false;
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials, $remember) && Auth::user()->status == config('const.status.active') &&
            empty(Auth::user()->deleted_at)) {
            return redirect()->intended(route('dashboard'));
        }
        $request->flash();
        return view('admin.auth.login', ['msg' => 'Email hoặc mật khẩu không đúng!']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect(route('login.index'));
    }
}
