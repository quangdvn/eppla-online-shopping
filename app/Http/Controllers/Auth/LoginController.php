<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

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

    // // override logout so cart contents remain:
    // public function logout(Request $request)
    // {
    //     $cart = collect(session()->get('cart'));
    //     $destination = \Auth::logout();
    //     if (!config('cart.destroy_on_logout')) {
    //         $cart->each(function ($rows, $identifier) {
    //             session()->put('cart.' . $identifier, $rows);
    //         });
    //     }
    //     return redirect()->to($destination);
    // }

    /**
    * Show the application's login form.
    * Override to parent function
    * to redirect after login to the previous page
    *
    * @return \Illuminate\Http\Response
    */
    public function showLoginForm()
    {
        session()->put('prev_url', url()->previous());

        return view('auth.login');
    }

    /**
     * Get the post register / login redirect path.
     * Set path to redirect from login
     *
     * @return string
     */
    public function redirectTo()
    {
        return str_replace(url('/'), '', session()->get('prev_url', '/'));
    }
}
