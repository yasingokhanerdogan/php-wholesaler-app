<?php

namespace App\Models;

use Core\Model;

class OrderModel extends Model{

    protected $table = "orders";

    function getOrderProducts(){
        return $this->hasMany("\App\Models\OrderProductModel", "order_no", "order_no");
    }

    function getPaymentNotice(){
        return $this->hasMany("\App\Models\PaymentNoticeModel", "order_no", "order_no");
    }

}