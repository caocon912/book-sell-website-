<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\Middleware\EnsureEmailIsVerified;
use App\Http\Requests\UserInfoRequest;
date_default_timezone_set('Asia/Saigon'); 
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
     * 
     * 
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
        return 'USERNAME';
    }
    
    protected function guard(){
        return Auth::guard('guard-name');
    }

    public function authenticate(Request $req){

        $validateData = $req->validate([
            'username'=>'required|max:20',
            'pwd'=>'required|min:6|max:20',
        ]);

        $credentials = [
            'username'=> $req->input('username'),
            'password' => $req->input('pwd'),
            'STATUS' => 1
        ];
        if (Auth::attempt($credentials)){
            $user = Auth::user();
            DB::beginTransaction();
            try{
                $user = DB::table('user')->where('USERNAME','=',$user->USERNAME)->first();
                $count_login = $user->COUNT_LOGIN;
                DB::table('user')->where('USERNAME','=',$user->USERNAME)->update(['COUNT_LOGIN'=>$count_login + 1]);
                DB::commit();
            } catch(Exception $e){
                DB::rollback();
            }
            return redirect()->route('shop')->with('success-message','Log in successfully!');
        } else {
            return redirect()->route('login')->with('error-message','Username or password not correct!Or your account not active');
        }
    }

    public function logout(){
        $username = Auth::user()->USERNAME;
        $result = DB::table('user')->join('role','role.ID','=','user.level')
            ->where([
                ['user.USERNAME','=',$username],
                ['user.STATUS','=',1]
            ])
            ->select('role.NAME as ROLE_NAME','user.ID','user.USERNAME','user.NAME','user.LEVEL','user.EMAIL','user.COUNT_LOGIN','user.STATUS')
            ->first();
        $flag = false;
        if ($result->ROLE_NAME=='ADMIN'){
            $flag = true;
        }
        Auth::logout();
        if (Auth::check()==false){
            if ($flag == true){
                //return redirect()->route('login-admin');
                return redirect()->route('shop')->with('success-message','Log out successfully!');
            } else {
                return redirect()->route('shop')->with('success-message','Log out successfully!');
            }
            
        }
    }
}
