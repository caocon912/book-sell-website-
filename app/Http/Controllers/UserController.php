<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function getUserInfo($username){
        $user_info = null;
        $user_info = DB::table('user')
        ->select('ID','USERNAME','PASSWORD','EMAIL','STATUS','COUNT_LOGIN','LEVEL','NAME','ADDRESS_1','ADDRESS_2','PHONE_NUMBER','AVATAR','CREATE_AT','UPDATE_AT')
        ->where('USERNAME','=',$username)
        ->get();
        if ($user_info->count()==0){
            return false;
        }
        return $user_info[0];
    }
    public function getView($username){
        $user_info = $this->getUserInfo($username);
        return view('profile',['user_info'=>$user_info]);
    }
    protected function updateUserInfo($username,Request $req){
        if (!empty($req->input('new_pwd'))){
            DB::table('user')
            ->where('USERNAME','=',$username)
            ->update([                
                "PASSWORD"=>Hash::make($req->input('new_pwd'))
            ]);
        }
        DB::table('user')
        ->where('USERNAME','=',$username)
        ->update([
            "NAME"=>$req->input('name'),
            "ADDRESS_1"=>$req->input('address_1'),
            "ADDRESS_2"=>$req->input('address_2'),
            "PHONE_NUMBER"=>$req->input('phone_number'),
            "EMAIL"=>$req->input('email'),
            "AVATAR"=>$req->input('avatar'),
            "UPDATE_AT"=>date('Y/m/d H:i:s')
        ]);
        return $this->getView($username);
    }
}
