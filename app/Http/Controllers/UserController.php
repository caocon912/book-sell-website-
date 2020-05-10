<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;

date_default_timezone_set('Asia/Saigon'); 

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
        if ($req->hasFile('avatar')){
            $image = $req->file('avatar');
            $file_name = time() . '.' . $image->getClientOriginalName();
            $file_size = $image->getSize();
            $file_type = $image->getMimeType();
            if ($file_size > 5000000){
                return redirect()->back()->with('error-message','File size maximum is 5MB');
            } else if ($file_type!='image/jpg' && $file_type!='image/png' && $file_type!='image/jpeg' ){
                return redirect()->back()->with('error-message','File type only jpg, jpeg, png');
            } else {
                if ($image->move('uploads',$file_name)){
                    DB::table('user')
                    ->where('USERNAME','=',$username)
                    ->update([
                        "AVATAR"=>$file_name,
                    ]);   
                } else {
                    return redirect()->back()->with('error-message','Upload file failed');
                }
            } 
        } 
        DB::table('user')
        ->where('USERNAME','=',$username)
        ->update([
            "NAME"=>$req->input('name'),
            "ADDRESS_1"=>$req->input('address_1'),
            "ADDRESS_2"=>$req->input('address_2'),
            "PHONE_NUMBER"=>$req->input('phone_number'),
            "EMAIL"=>$req->input('email'),
            "UPDATE_AT"=>date('Y/m/d H:i:s')
        ]);
        //return redirect()->route('profile',['username'=>$username])->with('success-message','Update info successfully');
        return redirect()->back()->with('success-message','Update info successfully');
    }

    protected function getAllUser(){
        $users = DB::table('user')
                    ->select('ID','USERNAME','PASSWORD','EMAIL','STATUS','COUNT_LOGIN','LEVEL','NAME','ADDRESS_1','ADDRESS_2','PHONE_NUMBER','CREATE_AT','UPDATE_AT','AVATAR')
                    ->paginate(5);
        return view('admin-user',['users'=>$users]);
    }
    protected function addUser(){

    }
    protected function insertUser(Request $req){
        $req->validate([
            'username'=>'required|max:20|unique:user',
            'email'=>'required|email:rfc,dns,filter|unique:user',
            'status'=>'required',
            'name'=>'required|min:6|max:40',
            'address_1'=>'required|min:10|max:40',
            'address_2'=>'nullable|max:40',
            'phone_number'=>'required|min:10|max:12',
        ]);
        $avatar = "";
        if ($req->hasFile('avatar')){
            $image = $req->file('avatar');
            $file_name = time() . '.' . $image->getClientOriginalName();
            $file_size = $image->getSize();
            $file_type = $image->getMimeType();
            if ($file_size > 5000000){
                return redirect()->back()->with('error-message','File size maximum is 5MB');
            } else if ($file_type!='image/jpg' && $file_type!='image/png' && $file_type!='image/jpeg' ){
                return redirect()->back()->with('error-message','File type only jpg, jpeg, png');
            } else {
                if ($image->move('uploads',$file_name)){
                    $avatar = $file_name;   
                } else {
                    return redirect()->back()->with('error-message','Upload file failed');
                }
            } 
        }
        DB::beginTransaction();
        try{
            $user_id = CommonController::getNextId('user');
            DB::table('user')->insert([
                'ID'=>$user_id,
                'USERNAME'=>$req->input('username'),
                'PASSWORD'=>Hash::make($req->input('pwd')),
                'EMAIL'=>$req->input('email'),
                'STATUS'=>$req->input('status'),
                'COUNT_LOGIN'=>0,
                'LEVEL'=>2,
                'NAME'=>$req->input('name'),
                'ADDRESS_1'=>$req->input('address_1'),
                'ADDRESS_2'=>$req->input('address_2'),
                'PHONE_NUMBER'=>$req->input('phone_number'),
                'AVATAR'=>$avatar,
                'CREATE_AT'=>date('Y/m/d H:i:s')
            ]);
            DB::commit();
            return redirect()->back()->with('success-message','Add user successfully.');
        } catch(Exception $e){
            DB::rollback();
            return redirect()->back()->with('error-message','Insert user fail.Try again or contact developer.');
        }

    }
    protected function editUser(){

    }
    protected function updateUser($user_id,Request $req){
        if (!empty($req->input('new_pwd'))){
            DB::table('user')
            ->where('ID','=',$user_id)
            ->update([                
                "PASSWORD"=>Hash::make($req->input('new_pwd'))
            ]);
        }
        if ($req->hasFile('avatar')){
            $image = $req->file('avatar');
            $file_name = time() . '.' . $image->getClientOriginalName();
            $file_size = $image->getSize();
            $file_type = $image->getMimeType();
            if ($file_size > 5000000){
                return redirect()->back()->with('error-message','File size maximum is 5MB');
            } else if ($file_type!='image/jpg' && $file_type!='image/png' && $file_type!='image/jpeg' ){
                return redirect()->back()->with('error-message','File type only jpg, jpeg, png');
            } else {
                if ($image->move('uploads',$file_name)){
                    DB::table('user')
                    ->where('ID','=',$user_id)
                    ->update([
                        "AVATAR"=>$file_name,
                    ]);   
                } else {
                    return redirect()->back()->with('error-message','Upload file failed');
                }
            } 
        } 
        DB::table('user')
        ->where('ID','=',$user_id)
        ->update([
            "USERNAME"=>$req->input('username'),
            "NAME"=>$req->input('name'),
            "ADDRESS_1"=>$req->input('address_1'),
            "ADDRESS_2"=>$req->input('address_2'),
            "PHONE_NUMBER"=>$req->input('phone_number'),
            "EMAIL"=>$req->input('email'),
            "STATUS"=>$req->input('status'),
            "UPDATE_AT"=>date('Y/m/d H:i:s')
        ]);
        //return redirect()->route('profile',['username'=>$username])->with('success-message','Update info successfully');
        return redirect()->back()->with('success-message','Update info successfully');
    }
    protected function deleteUser($user_id){
        DB::beginTransaction();        
        try{
            DB::table('user')->where('ID','=',$user_id)->delete();
            DB::commit();
            return redirect()->back()->with('success-message','Delete successfully');
        } catch(Exception $e){
            DB::rollback();
            return redirect()->back()->with('error-message','Delete user failed.Try again');
        }
    }

    
}
