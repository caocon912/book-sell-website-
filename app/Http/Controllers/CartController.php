<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\CommonController;

use Config\config;

class CartController extends Controller
{
    //get all item in cart
    public function getAllItemInCart(Request $req){
        
        $cart_items = null;
        
        //get ID cart with user login
        if (Auth::check()){
            $username = Auth::user()->USERNAME;
            $cart_id = DB::table('cart')
                        ->where('ID_USER','=',$username)
                        ->first();
            
            //get all items from cart_item has ID_CART = $cart_id
            $cart_items = DB::table('cart_items')
                            ->join('product','product.ID','=','cart_items.ID_PRODUCT')
                            ->select('product.ID as id_item','product.NAME as name_item','product.IMAGE as image_item','product.NEW_PRICE as price_item','cart_items.QUANLITY as quanlity')
                            ->where('ID_CART','=',$cart_id->ID)
                            ->get();

        } 
        //get all item from session
        else {
            if ($req->session()->exists('shopping-cart')){
                $cart_items = $req->session()->get('shopping-cart');
                var_dump($cart_items);exit; 
            }
        }
        if ($cart_items==null){
            echo "<script>";
            echo "window.confirm('You don't have any items')";
            echo "window.history.back();";
            echo "</script>";
        }
        else {
            return view('cart',['items'=>$cart_items]);
        }
    }
    //add item in cart
    public function addToCart(Request $req,$product_id){
        //user login save into database, else save into local storage
        if (Auth::check()){
            $username = Auth::user()->USERNAME;
            //check user has ID_cart ? set timeout 900h
            $is_cart_exist = DB::table('cart')->where('ID_USER','=',$username)->get();
            
            if ($is_cart_exist->count()==0){
                $ID_cart = CommonController::getNextId('cart');
                DB::table('cart')
                    ->insert([
                        'ID'=>$ID_cart,
                        'ID_USER'=>$username,
                        'TIMEOUT'=>'900',
                        'TIME_CREATE'=>$DATE
                    ]);
                DB::table('cart_items')
                    ->insert([
                        'ID_CART'=>$ID_cart,
                        'ID_PRODUCT'=>$product_id,
                        'QUANLITY'=>1,
                        'STYLE'=>'',
                        'COMMENT'=>'',
                        'FIELD_1'=>''
                    ]);
            } else {
                $is_product_exist = DB::table('cart_items')->where('ID_PRODUCT','=',$product_id)->get();
                if ($is_product_exist->count()==0){
                    DB::table('cart_items')
                    ->insert([
                        'ID_CART'=>$is_cart_exist[0]->ID,
                        'ID_PRODUCT'=>$product_id,
                        'QUANLITY'=>1,
                        'STYLE'=>'',
                        'COMMENT'=>'',
                        'FIELD_1'=>''
                    ]);
                } else {
                    $quanlity = $is_product_exist[0]->QUANLITY;
                    DB::table('cart_items')
                        ->where('ID_PRODUCT','=',$product_id)
                        ->update([
                            "QUANLITY"=>$quanlity + 1
                        ]);
                }
            }
        } else { //save to session
            $item = DB::table('product')->where('ID','=',$product_id)->first();
            $req->session()->push('shopping-cart',$item);
            
        }
        return redirect('view-cart-detail');
    }
    //delete item
    protected function deleteItem($product_id){
        DB::table('cart_items')->where('ID_PRODUCT','=',$product_id)->delete();
        return redirect('view-cart-detail');
    }
    //edit cart
    
    //delete cart after timeout:900
    public function deleteCartAfterTimeOut(){
        $data = DB::table('cart')->get();
        foreach($data as $item){
            $time_create = $item->TIME_CREATE;
            $time_remain = $DATE - $time_create;    
            if ($time_remain > 900){
                DB::table('cart_items')
                    ->where('ID_CART','=',$item->ID)
                    ->delete();
                DB::table('cart')->where('ID','=',$item->ID)->delete();
            }
            
        }        
    }

    public function updateCart(Request $req){
        //with user logined
        $ID_cart = DB::table('cart')
                        ->select('ID')
                        ->where('ID_USER','=',Auth::user()->USERNAME)
                        ->first();

        $ID_items = $req->input('id_item');
        $quanlity = $req->input('quanlity');
        var_dump($ID_items);exit;
        for ($i = 0; $i < count($ID_items); ++$i){
            $cart_items = DB::table()->where([['ID_CART','=',$ID_cart],['ID_PRODUCT','=',$quanlity]])->update([
                'QUANLITY'=>$quanlity[$i]
            ]);
        }
        return redirect('view-cart-detail');
    }
}
