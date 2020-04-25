<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function getViewDetail($product_id){
        $product_detail = DB::table('product')
                            ->join('category','category.ID','=','product.CATEGORY_ID')
                            ->select('product.ID','product.NAME','product.OLD_PRICE','product.DESCRIPTION','product.AMOUNT','product.NEW_PRICE','product.CATEGORY_ID as CATEGORY_ID','category.NAME as CATEGORY_NAME','product.IMAGE','product.STATUS')
                            ->where('product.ID','=',$product_id)->first();
        $products_relate = null;
        $products_relate = DB::table('product')                  
                            ->select('product.ID','product.NAME as NAME','product.OLD_PRICE as OLD_PRICE','product.DESCRIPTION as DESCRIPTION','product.AMOUNT as AMOUNT','product.NEW_PRICE as NEW_PRICE','product.IMAGE as IMAGE','product.STATUS as STATUS')
                            ->where('product.CATEGORY_ID','=',$product_detail->CATEGORY_ID)
                            // ->orderBy('ID','desc')  
                            // ->skip(10)
                            // ->take(5)
                            ->get();
        return view('product-detail',['product_detail'=>$product_detail,'products_relate'=>$products_relate]);
    }

}
