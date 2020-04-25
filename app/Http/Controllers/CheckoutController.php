<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\CommonController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Mail\OrderMail;
use Illuminate\Support\Facades\Mail;

date_default_timezone_set('Asia/Saigon'); 


class CheckoutController extends Controller
{
    public function getViewCheckout(Request $req){
        $cart_info = app('App\Http\Controllers\CartController')->getAllItemInCart($req);
        $total_pay = app('App\Http\Controllers\CartController')->totalOfCart($req);
        $customer = null;
        if (Auth::check()){
            $customer_info = app('App\Http\Controllers\UserController')->getUserInfo(Auth::user()->USERNAME);
            if ($customer_info != false){
                $customer = $customer_info;
            }
        }
        return view('checkout',['cart_items'=>$cart_info,'total_pay'=>$total_pay,'customer_info'=>$customer]);
    }
    public function checkCustomerIsExist($username){
        $customer = DB::table('customer')->where("USERNAME","=",Auth::user()->USERNAME)->get();
        if (count($customer)==0){
            return false;
        }
        return $customer;
    }
    public function formCheckoutSubmit(Request $req){
        $cart_info = app('App\Http\Controllers\CartController')->getAllItemInCart($req);

        if (Auth::check()){
            //$this->middleware('verified');
            $username = Auth::user()->USERNAME;
            $order_id = CommonController::getNextId('orders');
            DB::table('orders')->insert([
                "ID"=>$order_id,
                "ID_CART"=>$cart_info[0]->ID_CART,
                "CREATE_AT"=>date('Y/m/d H:i:s'),
                "STATUS"=>"A"
            ]);
            
            $customer_id = CommonController::getNextId('customer');
            
            DB::table('customer')->insert([
                "ID"=>$customer_id,
                "ID_ORDER"=>$order_id,
                "NAME"=>$req->input('full-name'),
                "EMAIL"=>$req->input('email'),
                "PHONE"=>$req->input('phone'),
                "ADDRESS"=>$req->input('address_1'),
                "REGISTED"=>1,
                "ADDRESS_1"=>$req->input('address_2'),
                "FIELD_1"=>"",
                "CREATE_AT"=>date('Y/m/d H:i:s'),
                "UPDATE_AT"=>date('Y/m/d H:i:s'),
                "USERNAME"=>Auth::user()->USERNAME
            ]);

            $order_detail_id = CommonController::getNextId('orders_detail');
            
            $total_pay = app('App\Http\Controllers\CartController')->totalOfCart($req);
            DB::table('orders_detail')->insert([
                "ID"=>$order_detail_id,
                "ID_ORDER"=>$order_id,
                "TOTAL"=>$total_pay,
                "ID_CUSTOMER"=>$customer_id,
                "CREATE_AT"=>date('Y/m/d H:i:s'),
                "UPDATE_AT"=>date('Y/m/d H:i:s'),
                "ADDRESS_1"=>$req->input('address_1'),
                "ADDRESS_2"=>$req->input('address_2'),
                "PHONE_NUMBER"=>$req->input('phone'),
                "STATUS"=>"A"
            ]);
            $cart_info = app('App\Http\Controllers\CartController')->getAllItemInCart($req);
            foreach($cart_info as $item){
                DB::table('orders_item')->insert([
                    "ID_ORDER"=>$order_id,
                    "ID_PRODUCT"=>$item->ID,
                    "QUANLITY"=>$item->QUANLITY,
                    "PRICE"=>$item->NEW_PRICE,
                    "CREATE_AT"=>date('Y/m/d H:i:s'),
                    //"UPDATE_AT"=>""
                ]);
            }

            //delete cart
            DB::table('cart_items')->where('ID_CART','=',$cart_info[0]->ID_CART)->delete();
            DB::table('cart')->where('ID','=',$cart_info[0]->ID_CART)->delete();
        } else {

        }
        //send mail
        Mail::to($req->input('email'))->send(new OrderMail());
        echo "<script>";
        echo "window.alert('You have ordered successfully.');";
        echo "window.location.href = '/shop';";
        echo "</script>";
    }
}
