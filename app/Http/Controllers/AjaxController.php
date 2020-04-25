<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AjaxController extends Controller
{
    public function getProductByCategoryId($category_id){
        $result = DB::table('product')
                    ->where([
                        ['CATEGORY_ID','=',$category_id],
                        ['AMOUNT','>',0],
                        ['STATUS','=',1]
                    ])
                    ->select('ID','NAME','OLD_PRICE','NEW_PRICE','DESCRIPTION','AMOUNT','IMAGE','STATUS','CATEGORY_ID')
                    ->get();
        
        if ($result->count() == 0){
            echo "<option value = 'empty'> Không có sản phẩm thuộc danh mục này!</option>";
        } else {
            foreach($result as $item){
                echo "<option value = '$item->ID'>".$item->NAME."</option>";
            }
        }
    }
    public function addProductIntoOrder(Request $req,$p_id){
       
       $item_add = DB::table('product')->where([['ID','=',$p_id],['STATUS','=',1],['AMOUNT','>',1]])->select('ID','NAME','OLD_PRICE','NEW_PRICE','DESCRIPTION','AMOUNT','CATEGORY_ID','IMAGE','STATUS')->first();
    
       $order_items = $req->session()->pull('order-items',[]);
       $number_of_item = count($order_items);
       if ($order_items != null && $number_of_item != 0){
          
           $is_item_exist = false;

           for ($i = 0;$i<count($order_items);$i++){
               if ($order_items[$i]->ID == $p_id){
                   $item_add->QUANLITY = $order_items[$i]->QUANLITY + 1;
                   //delete item has existed in session and replace new item with new quanlity
                   // unset($cart_info[$i]);
                   // $cart_info[$i] = $item_add;
                   array_splice($order_items,$i,1);
                   $order_items[$number_of_item - 1] = $item_add; 
                   $is_item_exist = true;
                   break;
               }
           }

           if ($is_item_exist==false){
               $item_add->QUANLITY = 1;
               $order_items[$number_of_item] = $item_add; 
           }
       } else {
           $item_add->QUANLITY = 1;
           $order_items[$number_of_item] = $item_add;
       }

       $req->session()->put('order-items',$order_items);
       foreach($order_items as $result){
        echo "<input type='hidden' value = '$result->ID' name='id_item'>";
        echo "<tr>";
        echo " <td class='cart-pic'><img src='../../uploads/$result->IMAGE' alt='' style='width:50px;height:50px'></td>
          <td class='cart-title'><h5>$result->NAME</h5></td>
          <td class='p-price'>$result->NEW_PRICE</td>
          <td class='qua-col'>
            <div class='quantity'>
              <div class='pro-qty'>
                <input type='number' min='1' value='$result->QUANLITY' name='quanlity' style='width:50px'>
              </div>
            </div>
          </td>
          <td class='total-price'>$result->NEW_PRICE</td>
          <td><button name='delete_item' id='delete_item_btn' onclick='deleteOrderItem($result->ID);' type='button'>Xóa</button></td>";
        echo "</tr>";
       }
    }
    protected function deleteProductIntoOrder(Request $req,$p_id){
        $order_items = $req->session()->pull('order-items',[]);
            for ($i = 0;$i<count($order_items);$i++){
                if ($order_items[$i]->ID == $p_id){
                    array_splice($order_items,$i,1);
                    break;
                }
            }
            $req->session()->put('order-items',$order_items);
            foreach($order_items as $result){
                echo "<input type='hidden' value = '$result->ID' name='id_item'>";
                echo "<tr>";
                echo " <td class='cart-pic'><img src='public/$result->IMAGE' alt='' style='width:50px;height:50px'></td>
                  <td class='cart-title'><h5>$result->NAME</h5></td>
                  <td class='p-price'>$result->NEW_PRICE</td>
                  <td class='qua-col'>
                    <div class='quantity'>
                      <div class='pro-qty'>
                        <input type='number' min='1' value='$result->QUANLITY' name='quanlity' style='width:50px'>
                      </div>
                    </div>
                  </td>
                  <td class='total-price'>$result->NEW_PRICE</td>
                  <td><button name='delete_item' id='delete_item_btn' type='button' onclick='deleteOrderItem($result->ID);'>Xóa</button></td>";
                echo "</tr>";
               }
    }

    public function getCategory($category_id){
        $category = DB::table('category')
                  ->where([
                      ['ID','=',$category_id],
                      ['STATUS','=',1]])
                  ->select('ID','NAME','DESCRIPTION','STATUS')
                  ->first();
        $response = '<div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Tên </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" value='.$category->NAME.'>
                        </div>
                     </div>';
              
        $response .='<div class="form-group ">
                        <label for="ccomment" class="control-label col-lg-2">Mô tả</label>
                        <div class="col-lg-10">
                        <textarea class="form-control " id="ccomment" name="comment">'.$category->DESCRIPTION.'</textarea>
                        </div>
                    </div>';

        $response .='<div class="form-group ">
                        <label for="ccomment" class="control-label col-lg-2">Status</label>
                        <div class="col-lg-10">';
                            if($category->STATUS==1){
                                $response .='<input type="radio" name="status" value="1" checked > Active
                                            <input type="radio" name="status" value="0"> Deactive';
                            } else {
                                $response .='<input type="radio" name="status" value="1" > Active
                                            <input type="radio" name="status" value="0" checked> Deactive';
                            }
                        
        $response .='</div></div>';
        echo $response;
        exit;
    }
}
