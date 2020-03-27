<?php

namespace App\Model;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class ProductObject 
{
   var $ID;

   var $NAME;

   var $CATEGORY_ID;

   var $AMOUNT;

   var $DESCRIPTION;

   var $IMAGE;

   var $OLD_PRICE;

   var $NEW_PRICE;

   var $STATUS;

   function ProductObject($id,$name,$price){
      $ID = $id;
      $NAME = $name;
      $NEW_PRICE = $price;
      return $this;
   }
}
?>