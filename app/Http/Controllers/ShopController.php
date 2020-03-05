<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class ShopController extends Controller
{
    //get all the product 
    protected function getAllProduct(){
        $products = DB::table('product')
                        ->join('category','category.ID','=','product.CATEGORY_ID')
                        ->select('product.*','category.NAME as CATEGORY_NAME')
                        ->where('product.STATUS','=','1')
                        ->get();
        return view('shop',['products'=>$products]);
    }

}
?>