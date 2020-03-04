<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class AdminProductController extends Controller
{
    //get all product
    protected function getAllProduct(){
        $products = DB::table('product')
                        ->join('category','category.ID','=','product.CATEGORY_ID')
                        ->select('product.*','category.NAME as CATEGORY_NAME')
                        ->get();
        return view('admin-product',['products'=>$products]);
    }

    //add product
    protected function addProduct(){
        $categories = DB::table('category')
                        ->get();
        return view('add-product',['categories'=>$categories]);
    }

    //insert product
    protected function insertProduct(Request $req){
        $req->validate([
            'name'=>'required|max:255',
            'category'=>'required',
            'amount'=>'required|integer',
            'new_price'=>'required|integer',
            'old_price'=>'integer',
            'amount'=>'integer'
        ]);
        
        $result = DB::table('product')
                    ->insert([
                        'NAME'=>$req->input('name'),
                        'CATEGORY_ID'=>$req->input('category'),
                        'AMOUNT'=>$req->input('amount'),
                        'DESCRIPTION'=>$req->input('comment'),
                        'OLD_PRICE'=>$req->input('old_price'),
                        'NEW_PRICE'=>$req->input('new_price'),
                        'IMAGE'=>$req->input('image'),
                        'STATUS'=>'1'
                    ]);
        return redirect('admin-product');
    }

    //edit product
    protected function editProduct($product_id){
        $product = DB::table('product')
                    ->join('category','category.ID','=','product.CATEGORY_ID')
                    ->select('product.*','category.NAME as CATEGORY_NAME','category.ID as CATE_ID')
                    ->where('product.ID','=',$product_id)
                    ->first();

        $categories = DB::table('category')
                    ->get();

        return view('edit-product',['product'=>$product,'categories'=>$categories]);
    }
    
    //update edit product
    protected function updateProduct($product_id,Request $req){
        DB::table('product')
            ->where('ID','=',$product_id)
            ->update([
                'NAME'=>$req->input('name'),
                'CATEGORY_ID'=>$req->input('category'),
                'AMOUNT'=>$req->input('amount'),
                'DESCRIPTION'=>$req->input('comment'),
                'OLD_PRICE'=>$req->input('old_price'),
                'NEW_PRICE'=>$req->input('new_price'),
                'IMAGE'=>$req->input('image')
            ]);

        return redirect('admin-product');
    }

    //delete product
    protected function deleteProduct($product_id){
        DB::table('product')
            ->where('ID','=',$product_id)
            ->delete();
        
        return redirect('admin-product');
    }

}
