<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';

    protected $primary_key = 'ID';

    protected $name = 'NAME';
    

    public $timestamps = false;
}
