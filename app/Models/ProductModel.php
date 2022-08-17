<?php

namespace App\Models;

use Core\Model;

class ProductModel extends Model{

    protected $table = "products";

    function getCategory(){
        return $this->hasOne("\App\Models\CategoryModel", "id", "category_id");
    }

    function getImages(){
        return $this->hasMany("\App\Models\ProductImageModel", "product_id", "id");
    }
}