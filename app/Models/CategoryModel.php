<?php

namespace App\Models;

use Core\Model;

class CategoryModel extends Model{

    protected $table = "categories";

    function getProducts(){
        return $this->hasMany("\App\Models\ProductModel", "category_id", "id");
    }
}