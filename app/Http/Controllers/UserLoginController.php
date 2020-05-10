<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Hash;

class UserLoginController extends Controller
{
    protected function formSubmit(Request $req){
        $req->validate([
            "username"=>"required",
            "pwd"=>"required"
        ]);
        $infoUser =  DB::table('user')
                        ->where([
                            ['USERNAME','=',$req->input('username')],
                            ['PASSWORD','=',md5($req->input('pwd'))]
                        ])
                        ->first();
        
        if ($infoUser!=null){
            //luu vao session
            session([
                'username'=>$infoUser->USERNAME,
                'level'=>$infoUser->LEVEL
            ]);
            echo "<script>window.confirm('Log in successfully!')</script>";
            return redirect()->route('shop');

        } else {
            //bao loi ra man hinh
            echo "<script>alert('Username or password do not correct!')</script>";
            return redirect()->back()->with();
        }
    }
}
