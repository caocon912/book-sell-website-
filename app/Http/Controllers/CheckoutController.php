<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\CommonController;

use App\Http\Controllers\CartController;

class CheckoutController extends Controller
{
    public function getViewCheckout(Request $req){
        $cart_info = app('App\Http\Controllers\CartController')->getAllItemInCart($req);
        return view('checkout',['cart_items'=>$cart_info]);
    }
    public function formCheckoutSubmit(Request $req){

    }
}
