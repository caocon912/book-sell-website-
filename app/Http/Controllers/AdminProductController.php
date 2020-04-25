<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class AdminProductController extends Controller
{
    public function uploadFile($file_class_name,Request $req){
            $image = $req->file($file_class_name);
            //get name file
            $file_name = time() . "." .$image->getClientOriginalName();
            //get extension of file
            $file_extension = $image->extension();
            //get temporary path
            $temp_path = $image->getRealPath();
            //get file size
            $file_size = $image->getSize();
            $file_type = $image->getMimeType();
            $destinationPath = "uploads";
            $flag = 1;
            if ($file_size >5000000){
                echo "Kích thước ảnh quá lớn, chỉ upload hình dưới 5MB";
                $flag = 0;
            } 
            if ($file_extension!='jpg' && $file_extension!='jpeg' && $file_extension!='png'){
                echo "Chỉ hỗ trợ file jpg,jpeg,png";
                $flag = 0;
            }
            return $flag;
    }
    //get all product
    protected function getAllProduct(){
        $products = DB::table('product')
                        ->join('category','category.ID','=','product.CATEGORY_ID')
                        ->select('product.*','category.NAME as CATEGORY_NAME')
                        ->get();
        $categories = DB::table('category')
                        ->select('ID','NAME','STATUS')
                        ->where('STATUS','=',1)
                        ->get();
        return view('admin-product',['products'=>$products,'categories'=>$categories]);
    }

    //add product
    protected function addProduct(){
        $categories = DB::table('category')
                        ->select('ID','NAME','STATUS')
                        ->where('STATUS','=',1)
                        ->get();
        return view('add-product',['categories'=>$categories]);
    }

    //insert product
    protected function insertProduct(Request $req){
        // $req->validate([
        //     'name'=>'required|max:255',
        //     'category'=>'required',
        //     'amount'=>'required|integer',
        //     'new_price'=>'required|integer',
        //     'old_price'=>'integer',
        //     'amount'=>'integer'
        // ]);
        //upload image
        if ($req->hasFile('imageUpload')){
            $image = $req->file('imageUpload');
            //get name file
            $file_name = time() . "." .$image->getClientOriginalName();
            //get extension of file
            $file_extension = $image->extension();
            //get temporary path
            $temp_path = $image->getRealPath();
            //get file size
            $file_size = $image->getSize();
            $file_type = $image->getMimeType();
            $destinationPath = "uploads";
            $flag = 1;
            if ($file_size >5000000){
                echo "Kích thước ảnh quá lớn, chỉ upload hình dưới 5MB";
                $flag = 0;
            } 
            if ($file_extension!='jpg' && $file_extension!='jpeg' && $file_extension!='png'){
                echo "Chỉ hỗ trợ file jpg,jpeg,png";
                $flag = 0;
            } 
            if ($flag == 0){
                echo "File chưa upload";
            } else {
                if ($image->move($destinationPath, $file_name)){

                    $result = DB::table('product')
                                ->insert([
                                    'NAME'=>$req->input('product_name'),
                                    'CATEGORY_ID'=>$req->input('category'),
                                    'AMOUNT'=>$req->input('amount'),
                                    'DESCRIPTION'=>$req->input('description'),
                                    'OLD_PRICE'=>$req->input('old_price'),
                                    'NEW_PRICE'=>$req->input('new_price'),
                                    'IMAGE'=> $file_name,
                                    'STATUS'=>'1'
                                ]);
                    return redirect('admin-product');
                }

            }
        } else {
            echo "Upload image please";
        }

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
        if ($req->hasFile('imageUpload')){
            $image = $req->file('imageUpload');
            $file_name = time() . '.' . $image->getClientOriginalName();
            if ($this->uploadFile('imageUpload',$req)==1){
                if ($image->move('uploads',$file_name)){
                    DB::table('product')
                    ->where('ID','=',$product_id)
                    ->update([
                        'NAME'=>$req->input('name'),
                        'CATEGORY_ID'=>$req->input('category'),
                        'AMOUNT'=>$req->input('amount'),
                        'DESCRIPTION'=>$req->input('comment'),
                        'OLD_PRICE'=>$req->input('old_price'),
                        'NEW_PRICE'=>$req->input('new_price'),
                        'IMAGE'=>$file_name
                    ]);
                    return redirect('admin-product');
                } else {
                    echo "Upload file thất bại";
                }
            } else {
                echo "File upload chưa hợp lệ";
            }
        } else {
            DB::table('product')
                ->where('ID','=',$product_id)
                ->update([
                    'NAME'=>$req->input('name'),
                    'CATEGORY_ID'=>$req->input('category'),
                    'AMOUNT'=>$req->input('amount'),
                    'DESCRIPTION'=>$req->input('comment'),
                    'OLD_PRICE'=>$req->input('old_price'),
                    'NEW_PRICE'=>$req->input('new_price')
                ]);          
                return redirect('admin-product');
        }

    }

    //delete product
    protected function deleteProduct($product_id){
        DB::table('product')
            ->where('ID','=',$product_id)
            ->delete();
        
        return redirect('admin-product');
    }

}
