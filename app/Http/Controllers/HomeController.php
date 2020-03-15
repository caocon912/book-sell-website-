<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\CommonController;

use App\Http\Controllers\CartController;

use App\Http\Controllers\ShopController;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware(['auth','verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function getData(){
        $cartInfo = CartController::getAllItemInCart();
        $cartQuanlity = $cartInfo->count();
        
        return view('home',['cart'=>$cartInfo,'cartQuanlity'=>$cartQuanlity]);
    }
}
