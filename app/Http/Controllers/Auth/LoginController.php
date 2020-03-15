<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\MustVerifyEmail;

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
    protected $redirectTo = RouteServiceProvider::HOME;

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
     * return username
     * created by:nhitty
     * created date:04/03/2020
     */
    public function username()
    {
        return 'username';
    }
    
    protected function guard(){
        return Auth::guard('guard-name');
    }

    public function authenticate(Request $req){
        $credential = $req->only('username','pwd');
        if (Auth::attempt(['username'=>$req->input('username'),'password'=>$req->input('pwd')])){
            return redirect()->intended('shop');
        } else {
            echo "<script>
                    var dicision = window.confirm('Incorrect login');
                    if (dicision == true){
                        window.history.back();
                    }
                  </script>";
            //return redirect()->back();
        }
    }

    public function logout(){
        Auth::logout();
        if (Auth::check()==false){
            echo "<script>
                    window.alert('You logout successfully!');
                </script>";
            return redirect('home');
        }
    }
    
}
