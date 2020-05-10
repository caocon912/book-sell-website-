<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Model\ProductObject;

use Illuminate\Pagination\LengthAwarePaginator;

class ShopController extends Controller
{
    
    //get all the product 
    protected function getAllProduct(){
        $categories = DB::table('category')
                        ->select('ID','NAME','DESCRIPTION','STATUS')
                        ->where('STATUS','=','1')
                        ->get();
        $products = DB::table('product')
                        ->join('category','category.ID','=','product.CATEGORY_ID')
                        ->select('product.*','category.NAME as CATEGORY_NAME')
                        ->where('product.STATUS','=','1')
                        ->paginate(2);
        return view('shop',['products'=>$products,'categories'=>$categories]);
    }
    //get all the product 
    protected function addFavoriteItemList(Request $req, $product_id,$product_name,$product_price){
        //save in session
        $item = new ProductObject($product_id,$product_name,$product_price);
        $favorite_items = $req->session()->pull('favorite-items',[]);
        $number_of_item = count($favorite_items);
        if ($number_of_item != 0 && $favorite_items!= null){

        } else {
            $favorite_items[$number_of_item] = $item;
        }
        $req->session()->put('favorite-items',$favorite_items);
        return redirect('shop');
    }
}
?>