<?php

namespace App\Models;

use Core\Model;

class CartModel extends Model{

    protected $table = "cart";

    function getProduct(){

        return $this->hasOne("\App\Models\ProductModel", "id", "product_id");
    }

    function getProductImages(){

        return $this->hasMany("\App\Models\ProductImageModel", "product_id", "product_id");
    }
}