<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminOrderController extends Controller
{
    public function getAllOrders(){
        $orders = null;
        $orders = DB::table('orders')
                    ->join('orders_detail','orders.ID','=','orders_detail.ID_ORDER')
                    ->select('orders.ID as ID','orders_detail.TOTAL as TOTAL','orders.CREATE_AT as CREATE_AT','orders_detail.ID_CUSTOMER as ID_CUSTOMER','orders_detail.PHONE_NUMBER as PHONE_NUMBER','orders_detail.ADDRESS_1 as ADDRESS_1','orders_detail.ADDRESS_2 as ADDRESS_2','orders.STATUS')
                    ->get();
        return $orders;            
    }
    public function getOrdersDetail($order_id){
        $order_info = null;
        $order_info = DB::table('orders_detail')
                        ->join('customer','orders_detail.ID','=','customer.ID')
                        ->select('orders_detail.ID as ID','orders_detail.ID_ORDER as ID_ORDER','TOTAL','ID_CUSTOMER','orders_detail.CREATE_AT as CREATE_AT','orders_detail.ADDRESS_1 as ADDRESS_1','ADDRESS_2','PHONE_NUMBER','STATUS','customer.NAME as CUSTOMER_NAME','customer.USERNAME as USERNAME','customer.EMAIL as EMAIL')
                        ->where('orders_detail.ID_ORDER','=',$order_id)
                        ->first();
        return $order_info;
    }
    public function getItemsOfOrders($order_id){
        $order_items = null;
        $order_items = DB::table('orders_item')
                        ->join('product','orders_item.ID_PRODUCT','=','product.ID')
                        ->select('orders_item.PRICE as PRICE','orders_item.CREATE_AT as CREATE_AT','NAME','IMAGE','product.ID as ID','QUANLITY')
                        ->where('ID_ORDER','=',$order_id)
                        ->get();
        return $order_items;
    }
    public function getView(){
        $orders = $this->getAllOrders();
        return view('admin-order',['orders'=>$orders]);
    }
    public function getViewDetail($order_id,$popup = 0){
        $order_detail = $this->getOrdersDetail($order_id);
        $order_items = $this->getItemsOfOrders($order_id);
        return view('admin-order-detail',['order_detail'=>$order_detail,'order_items'=>$order_items,'popup'=>$popup]);
    }
    protected function deleteOrder($order_id){
        DB::table('customer')->where('ID_ORDER','=',$order_id)->delete();
        DB::table('orders_item')->where('ID_ORDER','=',$order_id)->delete();
        DB::table('orders_detail')->where('ID_ORDER','=',$order_id)->delete();
        DB::table('orders')->where('ID','=',$order_id)->delete();
        
        return $this->getView();
    }
    
    protected function editOrderDetailSubmit(Request $req,$order_id){
        DB::beginTransaction();
        try {
            DB::table('orders_detail')
                ->where('ID_ORDER','=',$order_id)
                ->update([
                    'ADDRESS_1'=>$req->input('address_1'),
                    'ADDRESS_2'=>$req->input('address_2'),
                    'PHONE_NUMBER'=>$req->input('phone_number'),
                    'UPDATE_AT'=>date('Y/m/d H:i:s')
                ]);
            DB::table('customer')->where('ID_ORDER','=',$order_id)->update([
                'NAME'=>$req->input('customer_name'),
                'EMAIL'=>$req->input('email'),
                'PHONE'=>$req->input('phone_number'),
                'ADDRESS'=>$req->input('address_1'),
                'ADDRESS_1'=>$req->input('address_2'),
                'UPDATE_AT'=>date('Y/m/d H:i:s')
                ]);
            DB::commit();
        } catch (Throwable $e) {
            DB::rollback();
            throw $e;
        } catch (Exception $e){
            DB::rollback();
            throw $e;
        }
        return redirect()->route('detail-order', ['order_id' =>$order_id,'popup'=>0]);
    }
    protected function deleteOrderItem($order_id,$order_item_id){
        DB::table('orders_item')
            ->where([
                ['ID_PRODUCT','=',$order_item_id],
                ['ID_ORDER','=',$order_id]])
            ->delete();
        $popup = 1; //to open popup
        return redirect()->route('detail-order', ['order_id' =>$order_id,'popup'=>$popup]);
    }
    protected function updateOrderItem($order_id,$listItemsId,$listQuanlity){
        $listItemsId = explode(',',$listItemsId);
        $listQuanlity = explode(',',$listQuanlity);
    
        for ($i = 0; $i < count($listItemsId); ++$i){
            $cart_items = DB::table('orders_item')
                            ->where([['ID_ORDER','=',$order_id],['ID_PRODUCT','=',$listItemsId[$i]]])
                            ->update(['QUANLITY'=>$listQuanlity[$i]]);
        }
        $popup = 1;
        return redirect()->route('detail-order', ['order_id' =>$order_id,'popup'=>$popup]);
    }
    public function addOrder(Request $req){
        $req->session()->flush('order-items');
        $categories = DB::table('category')->select('ID','NAME')->where('STATUS','=',1)->get();
        return view('add-order',['categories'=>$categories]);
    }
    protected function insertOrder(Request $req){
        DB::beginTransaction();
        try{
            $order_id =  CommonController::getNextId('orders');
            $customer_id = CommonController::getNextId('customer');
            $order_detail_id = CommonController::getNextId('orders_detail');
            DB::table('orders')->insert([
                'ID'=>$order_id,
                'ID_CART'=>0,
                'CREATE_AT'=>date('Y/m/d H:i:s'),
                'STATUS'=>'A'
            ]);
            DB::table('customer')->insert([
                "ID"=>$customer_id,
                "ID_ORDER"=>$order_id,
                "NAME"=>$req->input('customer_name'),
                "EMAIL"=>$req->input('email'),
                "PHONE"=>$req->input('phone'),
                "ADDRESS"=>$req->input('address_1'),
                "REGISTED"=>1,
                "ADDRESS_1"=>$req->input('address_2'),
                "FIELD_1"=>"",
                "CREATE_AT"=>date('Y/m/d H:i:s'),
                "UPDATE_AT"=>date('Y/m/d H:i:s'),
                "USERNAME"=>$req->input('username')
            ]);

            $total_pay = 0;
            if ($req->session()->exists('order-items')){
                $order_items = $req->session()->get('order-items');
                foreach($order_items as $item){
                    $total_pay = $total_pay + ($item->QUANLITY * $item->NEW_PRICE);
                    DB::table('orders_item')->insert([
                        "ID_ORDER"=>$order_id,
                        "ID_PRODUCT"=>$item->ID,
                        "QUANLITY"=>$item->QUANLITY,
                        "PRICE"=>$item->NEW_PRICE,
                        "CREATE_AT"=>date('Y/m/d H:i:s')
                    ]);
                }
            }

            DB::table('orders_detail')->insert([
                "ID"=>$order_detail_id,
                "ID_ORDER"=>$order_id,
                "TOTAL"=>$total_pay,
                "ID_CUSTOMER"=>$customer_id,
                "CREATE_AT"=>date('Y/m/d H:i:s'),
                "UPDATE_AT"=>date('Y/m/d H:i:s'),
                "ADDRESS_1"=>$req->input('address_1'),
                "ADDRESS_2"=>$req->input('address_2'),
                "PHONE_NUMBER"=>$req->input('phone'),
                "STATUS"=>"A"
            ]);
            
            DB::commit();
        } catch(Exception $e){
            DB::rollback();
            throw $e;
        }
        $req->session()->flush('order-items');
        return $this->getView();
    }
    
}
