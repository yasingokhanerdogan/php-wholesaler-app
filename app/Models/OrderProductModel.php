<?php

namespace App\Models;

use Core\Model;

class OrderProductModel extends Model{

    protected $table = "orders_products";

    function getProduct(){
        return $this->hasOne("\App\Models\ProductModel", "id", "product_id");
    }

}