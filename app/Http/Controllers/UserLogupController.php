<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Hash;


class UserLogupController extends Controller
{

    protected function formSubmit(Request $req){
        $req->validate([
            'username'=>'required|max:20|min:6',
            'email'=>'required|email',
            'pwd'=>'required|max:20|min:6',
            're-pwd'=>'required|max:20|same:pwd|min:6'
        ]);

        $users = DB::table('user')->where('USERNAME','=',$req->input('username'),'or','EMAIL','=',$req->input('email'))->get();
        $userCount = $users->count();
        if ($userCount==0){
            $result = DB::table('user')->insert([
                        'USERNAME'=>$req->input('username'),
                        'EMAIL'=>$req->input('email'),
                        'PASSWORD'=>md5($req->input('pwd')),
                        'STATUS'=>'1',
                        'COUNT_LOGIN'=>'1'
            ]);
            $req->session()->put([
                'username'=>$req->input('username'),
                'pwd'=>$req->input('pwd'),
                'level'=>'2'
            ]);
            return redirect('shop');
        } else {
            echo ('Trùng username hoặc email');
            exit();
        }
        
    }
}
