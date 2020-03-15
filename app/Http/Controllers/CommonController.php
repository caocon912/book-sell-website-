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
}
