<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Mail\ConfirmRegisterMail;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\UserInfoRequest;
date_default_timezone_set('Asia/Saigon'); 
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */
   
    use RegistersUsers;

    
    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username'=>['required,max:20,min:6'],
            'email'=>['required,email'],
            'pwd'=>['required,max:20,min:6'],
            're-pwd'=>['required,max:20,same:pwd,min:6']
        ]);
    }

    /**
     * Create a new user instance after a valid registration.s
     */
    protected function create(UserInfoRequest $req)
    {
        $validated = $req->validated();

        $users = DB::table('user')->where('USERNAME','=',$req->input('username'),'or','EMAIL','=',$req->input('email'))->get();
        $userCount = $users->count();
        if ($userCount==0){
            $result = DB::table('user')->insert([
                        'USERNAME'=>$req->input('username'),
                        'EMAIL'=>$req->input('email'),
                        'PASSWORD'=>Hash::make($req->input('pwd')),
                        'STATUS'=>'1',//set status=0 if chua kich hoat tai khoan qua gmail
                        'COUNT_LOGIN'=>'1',
                        'CREATE_AT'=>date('Y/m/d H:i:s')
            ]);
            
            // send mail authentication
            Mail::to($req->input('email'))->send(new ConfirmRegisterMail());
            return redirect()->route('shop')->with('success-message','Registerd successfully!');
        } else {
            return redirect()->back()->with('success-message','Registerd successfully!');
        }
    }

    protected function guard(){
        return Auth::guard('guard-name');
    }


}
