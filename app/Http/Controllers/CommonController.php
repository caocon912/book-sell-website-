<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class CommonController extends Controller
{
    public static function getNextId($table_name){
        $ID_current = DB::table($table_name)->select(DB::raw('max(ID) as ID_max'))->first();
        $ID_next = $ID_current->ID_max + 1;
        
        return $ID_next;
    }
    protected function getNotification(){
        //date("Y-m-d H:i:s",strtotime('CREATE-AT'));
        $date = date("Y-m-d");
        
        $query = 'select ID,USERNAME, NAME, STATUS,CREATE_AT from user where cast(CREATE_AT as date)="' . $date.'"';
        $new_accounts = DB::select($query);
        $count_new_acc = count($new_accounts);
        $query1 = 'select ID, CREATE_AT from orders where cast(CREATE_AT as date)="'. $date .'" and STATUS = 1';
        $new_orders = DB::select($query1);
        $count_new_orders = count($new_orders);
        $outstock_products = DB::table('product')->where([['AMOUNT','<','10'],['STATUS','=',1]])->get();
        $count_outstock_products = count($outstock_products);
        return view('admin',['date'=>$date,'count_new_acc'=>$count_new_acc,'count_new_orders'=>$count_new_orders,'count_outstock_products'=>$count_outstock_products]);
    }
}
