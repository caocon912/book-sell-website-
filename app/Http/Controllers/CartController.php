<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\CommonController;

use Config\config;

class CartController extends Controller
{
    public function checkCartExistInDB(){
        $cart_id = DB::table('cart')
                        ->where('ID_USER','=',$username)
                        ->first();
            if ($cart_id == null){                
                $ID_cart = CommonController::getNextId('cart');
            }
    }
    public function totalOfCart(Request $req){
        $cart_items = CartController::getAllItemInCart($req);
        $sub_total = 0;
        if ($cart_items!=null && count($cart_items)!=0){
            foreach ($cart_items as $item){
                $sub_total = $sub_total + ($item->QUANLITY * $item->NEW_PRICE);
            }
        }
        return $sub_total;
    }
    public function saveSessionCartToDB(Request $req){
            $username = Auth::user()->USERNAME;
            
            $items_session = $req->session()->get('shopping-cart');

            $cart_id = DB::table('cart')
                        ->where('ID_USER','=',$username)
                        ->first();

            if ($cart_id == null){                
                $ID_cart = CommonController::getNextId('cart');
                
                DB::table('cart')
                    ->insert([
                        'ID'=>$ID_cart,
                        'ID_USER'=>$username,
                        'TIMEOUT'=>'900',
                        'TIME_CREATE'=>date('Y/m/d H:i:s')
                    ]);
                foreach ($items_session as $item){
                    DB::table('cart_items')
                    ->insert([
                        'ID_CART'=>$ID_cart,
                        'ID_PRODUCT'=>$item->ID,
                        'QUANLITY'=>$item->QUANLITY,
                        'STYLE'=>'',
                        'COMMENT'=>'',
                        'FIELD_1'=>''
                    ]);
                }
            } else {
                foreach($items_session as $item){
                    $is_product_exist = DB::table('cart_items')->where([['ID_CART','=',$cart_id->ID],['ID_PRODUCT','=',$item->ID]])->get();
                    if ($is_product_exist->count()==0){
                        DB::table('cart_items')
                        ->insert([
                            'ID_CART'=>$cart_id->ID,
                            'ID_PRODUCT'=>$item->ID,
                            'QUANLITY'=>$item->QUANLITY,
                            'STYLE'=>'',
                            'COMMENT'=>'',
                            'FIELD_1'=>''
                        ]);
                    } else {
                        $quanlity = $is_product_exist[0]->QUANLITY;
                        DB::table('cart_items')
                            ->where('ID_PRODUCT','=',$item->ID)
                            ->update([
                                "QUANLITY"=>$quanlity + $item->QUANLITY
                            ]);
                    }
                }
            }
            $req->session()->pull('shopping-cart',[]);
    }
    public function getAllItemInCart(Request $req){
        
        $cart_items = null;
   
        //get ID cart with user login
        if (Auth::check()){
            $username = Auth::user()->USERNAME;
            $cart_id = DB::table('cart')
                        ->where('ID_USER','=',$username)
                        ->first();

            if ($req->session()->exists('shopping-cart')){
                CartController::saveSessionCartToDB($req,$cart_id);
            }
            
            if ($cart_id != null){
                $cart_items = DB::table('cart_items')
                                ->join('product','product.ID','=','cart_items.ID_PRODUCT')
                                ->select('product.ID as ID','product.NAME as NAME','product.IMAGE as IMAGE','product.NEW_PRICE as NEW_PRICE','cart_items.QUANLITY as QUANLITY','cart_items.ID_CART as ID_CART')
                                ->where('ID_CART','=',$cart_id->ID)
                                ->get();
            }
    
        } 
        //get all item from session
        else {
            if ($req->session()->exists('shopping-cart')){
                $cart_items = $req->session()->get('shopping-cart');
                
            }
        }

        return $cart_items;
    }
    public static function getNewestItemsInCart(Request $req){
        $cart_items = null;
        $sub_total = 0;
        //get ID cart with user login
        if (Auth::check()){
            $username = Auth::user()->USERNAME;
            $cart_id = DB::table('cart')
                        ->where('ID_USER','=',$username)
                        ->first();

            if ($req->session()->exists('shopping-cart')){
                CartController::saveSessionCartToDB($req,$cart_id);
            }
            
            if ($cart_id != null){
                $cart_items = DB::table('cart_items')
                                ->join('product','product.ID','=','cart_items.ID_PRODUCT')
                                ->select('product.ID as ID','product.NAME as NAME','product.IMAGE as IMAGE','product.NEW_PRICE as NEW_PRICE','cart_items.QUANLITY as QUANLITY','cart_items.ID_CART as ID_CART')
                                ->where('ID_CART','=',$cart_id->ID)
                                ->skip(10)->take(5)
                                ->get();
            }
    
        } 
        //get all item from session
        else {
            if ($req->session()->exists('shopping-cart')){
                $cart_items = $req->session()->get('shopping-cart');
            }
        }
        $sub_total = 0;
        return view('header',['cart_items'=>$cart_items,'sub_total'=>$sub_total]);
    }
    public function getViewCart(Request $req){
        $cart_items = CartController::getAllItemInCart($req);
        $sub_total = 0;
        if ($cart_items!=null && count($cart_items)!=0){
            foreach ($cart_items as $item){
                $sub_total = $sub_total + ($item->QUANLITY * $item->NEW_PRICE);
            }
        }
        return view('cart',['items'=>$cart_items,'sub_total'=>$sub_total]);
    }
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
                        'TIME_CREATE'=>date('Y/m/d H:i:s')
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
            $item_add = DB::table('product')->where('ID','=',$product_id)->first();
            $cart_info = $req->session()->pull('shopping-cart',[]);
            $number_of_item = count($cart_info);
            if ($cart_info != null && $number_of_item != 0){
               
                $is_item_exist = false;

                for ($i = 0;$i<count($cart_info);$i++){
                    if ($cart_info[$i]->ID == $product_id){
                        $item_add->QUANLITY = $cart_info[$i]->QUANLITY + 1;
                        //delete item has existed in session and replace new item with new quanlity
                        // unset($cart_info[$i]);
                        // $cart_info[$i] = $item_add;
                        array_splice($cart_info,$i,1);
                        $cart_info[$number_of_item - 1] = $item_add; 
                        $is_item_exist = true;
                        break;
                    }
                }

                if ($is_item_exist==false){
                    $item_add->QUANLITY = 1;
                    $cart_info[$number_of_item] = $item_add; 
                }
            } else {
                $item_add->QUANLITY = 1;
                $cart_info[$number_of_item] = $item_add;
            }

            $req->session()->put('shopping-cart',$cart_info);
        }
        return redirect('view-cart-detail');
    }
    //delete item
    protected function deleteItem(Request $req,$product_id){
        if (Auth::check()){
            $username = Auth::user()->USERNAME;
            $cart_id = DB::table('cart')->where('ID_USER','=',$username)->first();
            $item_del = DB::table('cart_items')->where([['ID_CART','=',$cart_id->ID],['ID_PRODUCT','=',$product_id]])->delete();
            $cart_info = DB::table('cart_items')->where('ID_CART','=',$cart_id->ID)->get();
        } else {
            $cart_info = $req->session()->pull('shopping-cart',[]);
            for ($i = 0;$i<count($cart_info);$i++){
                if ($cart_info[$i]->ID == $product_id){
                    array_splice($cart_info,$i,1);
                    break;
                }
            }
            $req->session()->put('shopping-cart',$cart_info);
        }
        return redirect('view-cart-detail');
    }
    //edit cart
    
    //delete cart after timeout:900
    public function deleteCartAfterTimeOut(){
        $data = DB::table('cart')->get();
        foreach($data as $item){
            $time_create = $item->TIME_CREATE;
            $time_remain = date('Y/m/d H:i:s') - $time_create;    
            if ($time_remain > 900){
                DB::table('cart_items')
                    ->where('ID_CART','=',$item->ID)
                    ->delete();
                DB::table('cart')->where('ID','=',$item->ID)->delete();
            }
        }        
    }

    public function updateCart(Request $req,$listItemsId,$listQuanlity){
        $listItemsId = explode(',',$listItemsId);
        $listQuanlity = explode(',',$listQuanlity);
       
        if (Auth::check()){
            //with user logined
            $ID_cart = DB::table('cart')
            ->where('ID_USER','=',Auth::user()->USERNAME)
            ->first();

            for ($i = 0; $i < count($listItemsId); ++$i){
                $cart_items = DB::table('cart_items')->where([['ID_CART','=',$ID_cart->ID],['ID_PRODUCT','=',$listItemsId[$i]]])->update([
                'QUANLITY'=>$listQuanlity[$i]
                ]);
            }
        } else {
            $cart_info = $req->session()->pull('shopping-cart',[]);
            for($i = 0;$i < count($listItemsId); ++$i){
                if ($cart_info[$i]->ID == $listItemsId[$i]){
                    $cart_info[$i]->QUANLITY = $listQuanlity[$i];
                }
            }
            $req->session()->put('shopping-cart',$cart_info);    
        }

        return redirect('view-cart-detail');
    }
}
