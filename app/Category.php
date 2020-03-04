<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';

    protected $primary_key = 'ID';

    public $timestamps = false;
}
