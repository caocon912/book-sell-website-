<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class AdminCategoryController extends Controller
{
    //get all category
    protected function getAllCategory(){
        $categories = DB::table('category')
                        ->paginate(5);
        return view('admin-category',['categories'=>$categories]);
    }

    //add category
    protected function addCategory(){
        return view('add-category');
    }

    //insert category
    protected function insertCategory(Request $req){
        $validateData = $req->validate([
            'name'=>'required|max:255',
            'status'=>'required'
        ]);
        
        $result = DB::table('category')
                    ->insert([
                        'NAME'=>$req->input('name'),
                        'DESCRIPTION'=>$req->input('comment'),
                        'STATUS'=>$req->input('status')
                    ]);

        return redirect('admin-category');
    }

    //edit category
    protected function editCategory($category_id){
        $category = DB::table('category')
                    ->where('category.ID','=',$category_id)
                    ->first();

        return view('edit-category',['category'=>$category]);
    }
    
    //update edit category
    protected function updateCategory($category_id,Request $req){
        $validateData = $req->validate([
            'name'=>'required|max:255',
            'description'=>'nullable|max:255',
            'status'=>'required'
        ]);
        DB::table('category')
            ->where('ID','=',$category_id)
            ->update([
                'NAME'=>$req->input('name'),
                'DESCRIPTION'=>$req->input('comment'),
                'STATUS'=>$req->input('status')
            ]);

        return redirect('admin-category');
    }

    //delete product
    protected function deleteCategory($category_id){
        DB::table('category')
            ->where('ID','=',$category_id)
            ->delete();
        
        return redirect('admin-category');
    }
}
